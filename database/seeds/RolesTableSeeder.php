<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\Role::create([
            'name' => 'admin',
            'label' => 'Administrator',
        ]);

        $member = \App\Role::create([
            'name' => 'member',
            'label' => 'Member',
        ]);

        $viewToken = \App\Permission::create([
            'name' => 'view-api-token',
            'label' => 'View API token',
        ]);

        $admin->givePermissionTo($viewToken);
        $member->givePermissionTo($viewToken);
    }
}
