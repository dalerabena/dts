<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('users')->get()->count() == 0) {

            $password = '12';

            DB::table('users')->insert([
                [
                    'name' => 'Administrator',
                    'email' => 'admin@admin.com',
                    'password' => Hash::make($password),
                    'admin' => 1
                ],
                [
                    'name' => 'Office 1',
                    'email' => 'office1@test.com',
                    'password' => Hash::make($password),
                    'admin' => 0
                ],
                [
                    'name' => 'Office 2',
                    'email' => 'office2@test.com',
                    'password' => Hash::make($password),
                    'admin' => 0
                ],
            ]);
        }
    }
}
