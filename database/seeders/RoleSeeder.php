<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles = [
            ['name' => 'Admin', 'desc' => 'Administrator with full access', 'status' => 1],
            ['name' => 'Editor', 'desc' => 'Can edit content', 'status' => 1],
            ['name' => 'User', 'desc' => 'Regular user with limited access', 'status' => 1],
        ];

         // Create each role
         foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
