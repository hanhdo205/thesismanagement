<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Spatie\Permission\Models\Role;

class UsersImport implements ToModel, WithStartRow {

	protected $topic_id;
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function __construct($topic_id) {
		$this->topic_id = $topic_id;
	}

	/**
	 * @return int
	 */
	public function startRow(): int {
		return 2;
	}

	/**
	 * @param array $row
	 *
	 * @return \Illuminate\Database\Eloquent\Model|null
	 */
	public function model(array $row) {
		if (!User::where('email', '=', $row[1])->exists()) {
			$user = new User([
				'name' => $row[0],
				'email' => $row[1],
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
					['topic_id' => $this->topic_id, 'user_id' => $user->id],
					['topic_id' => $this->topic_id, 'user_id' => $user->id]
				);
			return $user;
		} else {
			$user = User::where('email', '=', $row[1])->first();
			$user->update(['name' => $row[0]]);
			$role = DB::table('roles')->where('name', 'Teacher')->value('name');
			if (empty($role)) {
				Role::create(['name' => 'Teacher']);
			}

			$user->assignRole('Teacher');
			$user->save();
			DB::table('reviews')
				->updateOrInsert(
					['topic_id' => $this->topic_id, 'user_id' => $user->id],
					['topic_id' => $this->topic_id, 'user_id' => $user->id]
				);
			return $user;
		}

	}
}