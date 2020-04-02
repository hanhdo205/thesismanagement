<?php

namespace App\Imports;

use App\User;
use DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Spatie\Permission\Models\Role;

class UsersImport implements ToModel, WithStartRow {

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
				'password' => \Hash::make($row[2]),
			]);
			$role = DB::table('roles')->where('name', $row[3])->value('name');
			if (empty($role)) {
				Role::create(['name' => $row[3]]);
			}

			$user->assignRole($row[3]);
			return $user;
		}
	}
}