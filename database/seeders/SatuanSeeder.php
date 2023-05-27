<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Satuan;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Satuan::truncate();
        Schema::enableForeignKeyConstraints();

        $satuan = [
            ['nama' => 'Box'],
            ['nama' => 'Kit'],
            ['nama' => 'Vial'],
            ['nama' => 'Liter'],
            ['nama' => 'Set'],
            ['nama' => 'Pcs'],
            ['nama' => 'Botol'],
            ['nama' => 'Unit'],
            ['nama' => 'Roll'],
            ['nama' => 'Pak'],
            ['nama' => 'Gln'],
            ['nama' => 'Psg'],
            ['nama' => 'Dus'],
            ['nama' => 'Lbr'],
        ];

        foreach ($satuan as $item) {
            Satuan::create([
                'nama_satuan' => $item['nama']
            ]);
        }
    }
}
