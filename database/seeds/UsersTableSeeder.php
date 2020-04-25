<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            [
                'username' => 'root',
                'nama' => 'root',
                'hak_akses' => 'root',
                'created_at' => date('Y-m-d H:i:s'),
                'password' => bcrypt('root'),
            ],
            [
                'username' => 'admin',
                'nama' => 'admin',
                'hak_akses' => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'password' => bcrypt('admin'),

            ],
            [
                'username' => 'user',
                'nama' => 'user',
                'hak_akses' => 'user',
                'created_at' => date('Y-m-d H:i:s'),
                'password' => bcrypt('user'),

            ],
        ]);

    }
}
