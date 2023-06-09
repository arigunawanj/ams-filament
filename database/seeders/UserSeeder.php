<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $user = User::create([
            'name' => 'Ari Gunawan Jatmiko',
            'email' => 'arigunawanjatmiko@gmail.com',
            'password' => Hash::make(12345678)
        ]);

        $role = Role::create(['name' => 'Super Admin']);
        $user->assignRole($role);
        
    }
}
