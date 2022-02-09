<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
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
                'name'          => 'administrator@sales.com',
                'password'      => Hash::make('administrator'),
                'type'          => 1,
                'date_register' => now(),
                'ip'            => \Request::ip(),
            ]
        ]);
    }
}
