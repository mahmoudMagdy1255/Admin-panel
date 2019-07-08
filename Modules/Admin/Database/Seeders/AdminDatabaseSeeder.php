<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Admin\Repositories\AdminRepository;

class AdminDatabaseSeeder extends Seeder {
	public function __construct(AdminRepository $adminRepository) {
		$this->adminRepository = $adminRepository;
	}
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Model::unguard();

		$this->adminRepository->create([

			'full_name' => 'Root',
			'email' => 'admin@admin.com',
			'password' => bcrypt('admin'),

		]);
	}
}
