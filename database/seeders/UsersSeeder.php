<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'uid' => 1,
                'username' => 'user',
                'password' => password_hash('user123', PASSWORD_BCRYPT),
                'nama' => 'User'
            ]
        ]);
    }
}
