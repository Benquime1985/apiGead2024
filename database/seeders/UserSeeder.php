<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                'name' => 'Sergio Benjamin Guinto',
                'email' => 'SergiB@hotmail.com',
                'password' => Hash::make('1234'),
                'role_id' => 1,
                'position_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('users')->insert(
            [
                'name' => 'Ingrid Leyva',
                'email' => 'Villey@hotmail.com',
                'password' => Hash::make('1234'),
                'role_id' => 2,
                'position_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('users')->insert(
            [
                'name' => 'Sergio Guinto',
                'email' => 'Sguii@hotmail.com',
                'password' => Hash::make('1234'),
                'role_id' => 2,
                'position_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('users')->insert(
            [
                'name' => 'Ingrid Quimey',
                'email' => 'Quime202@hotmail.com',
                'password' => Hash::make('1234'),
                'role_id' => 2,
                'position_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );
    }
}
