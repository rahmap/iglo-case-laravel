<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
	    $permissions = PermissionEnum::getAll('name');
	    
	    collect($permissions)->each(function ($permission) {
		    Permission::firstOrCreate($permission);
	    });
		
		$users = [
			[
				'name' => 'Customer Service',
				'email' => 'customer_service_case_laravel@yopmail.com',
				'password' => bcrypt('abc12345'),
				'avatar' => 'images/cs-profile.png',
				'role' => RoleEnum::CustomerService,
				'permissions' => [
					PermissionEnum::AccountOpeningsAccess,
					PermissionEnum::AccountOpeningsCRUD
				]
			],
			[
				'name' => 'Supervisor',
				'email' => 'supervisor_case_laravel@yopmail.com',
				'password' => bcrypt('abc12345'),
				'avatar' => 'images/supervisor-profile.png',
				'role' => RoleEnum::Supervisor,
				'permissions' => [
					PermissionEnum::AccountOpeningsAccess,
					PermissionEnum::AccountOpeningsApprover
				]
			]
		];
		
		collect($users)->each(function ($item) {
			$user = User::create(Arr::except($item, ['role', 'permissions']));
			$role = Role::firstOrCreate([
				'name' => $item['role']
			]);
	        $userRole = $user->assignRole($role);
			$userRole->syncPermissions($item['permissions']);
		});
    }
}
