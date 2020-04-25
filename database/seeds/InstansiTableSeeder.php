<?php

use Illuminate\Database\Seeder;
use App\Instansi;

class InstansiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Instansi::create([
            'nama_instansi' => 'PT Cahaya Pertama'
        ]);
    }
}
