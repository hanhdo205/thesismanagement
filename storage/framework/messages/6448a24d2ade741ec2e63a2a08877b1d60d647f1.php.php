<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	function __construct() {
		$this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'show']]);
		$this->middleware('permission:user-create', ['only' => ['create', 'store', 'register']]);
		$this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
		$this->middleware('permission:user-delete', ['only' => ['destroy']]);
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
		$data = User::orderBy('id', 'DESC')->paginate(5);
		return view('users.index', compact('data'))
			->with('i', ($request->input('page', 1) - 1) * 5);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$roles = Role::pluck('name', 'name')->all();
		return view('users.create', compact('roles'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$this->validate($request, [
			'name' => 'required',
			'email' => 'required|email|unique:users,email',
			'password' => 'required|same:confirm-password',
			'roles' => 'required',
		]);

		$input = $request->all();
		$input['password'] = Hash::make($input['password']);

		$user = User::create($input);
		$user->assignRole($request->input('roles'));

		return redirect()->route('users.index')
			->with('success', _i('User created successfully'));
	}

	/**
	 * Store a newly created resource in opponent management screen.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function register(Request $request) {
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'email' => 'required|email',
		]);

		if ($validator->fails()) {
			return response()->json(['error' => $validator->errors()]);
		}
		$email = $request->input('email');
		$name = $request->input('name');
		$topic_id = $request->input('topic_id');

		if (!User::where('email', '=', $email)->exists()) {
			$user = new User([
				'name' => $name,
				'email' => $email,
				'password' => \Hash::make('123456'),
			]);
			$role = DB::table('roles')->where('name', 'Teacher')->value('name');
			if (empty($role)) {
				Role::create(['name' => 'Teacher']);
			}

			$user->assignRole('Teacher');
			$user->save();
			DB::table('reviews')
				->updateOrInsert(
					['topic_id' => $topic_id, 'user_id' => $user->id],
					['topic_id' => $topic_id, 'user_id' => $user->id]
				);
			return $user;
		} else {
			$user = User::where('email', '=', $email)->first();
			$user->update(['name' => $name]);
			$role = DB::table('roles')->where('name', 'Teacher')->value('name');
			if (empty($role)) {
				Role::create(['name' => 'Teacher']);
			}

			$user->assignRole('Teacher');
			$user->save();
			DB::table('reviews')
				->updateOrInsert(
					['topic_id' => $topic_id, 'user_id' => $user->id],
					['topic_id' => $topic_id, 'user_id' => $user->id]
				);
			return $user;
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		$user = User::find($id);
		return view('users.show', compact('user'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$user = User::find($id);
		$roles = Role::pluck('name', 'name')->all();
		$userRole = $user->roles->pluck('name', 'name')->all();

		return view('users.edit', compact('user', 'roles', 'userRole'));
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function profile() {
		$user = Auth::user();
		$roles = Role::pluck('name', 'name')->all();
		$userRole = $user->roles->pluck('name', 'name')->all();

		return view('users.profile', compact('user', 'roles', 'userRole'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$this->validate($request, [
			'name' => 'required',
			'email' => ['required', 'email', 'unique:users,email,' . $id],
			'password' => ['required', 'string', 'min:8', 'same:confirm-password'],
			'roles' => 'required',
		]);

		$input = $request->all();
		if (!empty($input['password'])) {
			$input['password'] = Hash::make($input['password']);
		} else {
			$input = array_except($input, array('password'));
		}

		$user = User::find($id);
		$user->update($input);
		DB::table('model_has_roles')->where('model_id', $id)->delete();

		$user->assignRole($request->input('roles'));

		/*return redirect()->route('users.index')
			->with('success', 'Profile updated successfully');*/
		return redirect()->back()->with('success', _i('Profile updated successfully'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		User::find($id)->delete();
		return redirect()->route('users.index')
			->with('success', _i('User deleted successfully'));
	}
}