<?php

use App\Farmer\Models\Role;
use Illuminate\Database\Seeder;
use App\Farmer\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $admin = Role::create([
            'name' => 'admin',
            'label' => 'Administrator',
        ]);

        $member = Role::create([
            'name' => 'member',
            'label' => 'Member',
        ]);

        $viewToken = Permission::create([
            'name' => 'view-api-token',
            'label' => 'View API token',
        ]);

        $admin->givePermissionTo($viewToken);
        $member->givePermissionTo($viewToken);
    }
}
