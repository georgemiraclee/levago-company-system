<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $management = Role::create(['name' => 'management']);

        // Assign admin role ke user pertama
        $user = User::first();
        if ($user) {
            $user->assignRole('admin');
        }
    }
}