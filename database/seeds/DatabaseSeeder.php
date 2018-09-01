<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        \App\Models\User::create(array(
            'name'     => 'Administrator',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('123456'),
        ));
    }
}
