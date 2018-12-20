<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $admin = Role::updateOrCreate([
            'name' => 'admin',
        ]);

        $member = Role::updateOrCreate([
            'name' => 'member',
        ]);

        $viewApiToken = Permission::updateOrCreate([
            'name' => 'view-api-token',
        ]);

        $admin->givePermissionTo($viewApiToken);
        $member->givePermissionTo($viewApiToken);
    }
}
