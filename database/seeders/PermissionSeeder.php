<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Permission::truncate();
        Schema::enableForeignKeyConstraints();

        $permission = [
            ['name' => 'Menambah Data'],
            ['name' => 'Mengubah Data'],
            ['name' => 'Menghapus Data'],
        ];

        foreach ($permission as $nilai) {
            Permission::insert([
                'name' => $nilai['name'],
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
