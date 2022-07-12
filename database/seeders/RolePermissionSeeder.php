<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name'  => 'Administrator'
            ],
            [
                'name'  => 'Clerk'
            ]
        ];

        foreach ($roles as $role)
        {
            Role::create($role);
        }
    }
}
