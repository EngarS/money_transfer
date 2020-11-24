<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->upsert([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => bcrypt('secret'),
            'is_admin' => true
        ], ['balance' => '100500']);

        //if (User::all()->count() == 0) {
            \App\Models\User::factory(10)->create();
        //}
    }
}
