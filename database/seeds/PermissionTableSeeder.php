<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$permissions = [
			'user-list',
			'user-create',
			'user-edit',
			'user-delete',
			'role-list',
			'role-create',
			'role-edit',
			'role-delete',
			'topic-list',
			'topic-create',
			'topic-edit',
			'topic-delete',
			'essay-list',
			'essay-create',
			'essay-edit',
			'essay-delete',
			'opponent-sendrequest',
			'opponent-confirmation',
		];

		foreach ($permissions as $permission) {
			Permission::create(['name' => $permission]);
		}
	}
}
