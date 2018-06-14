<?php

use Illuminate\Database\Seeder;
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
        //
        DB::table('users')->insert([

            'name'=>str_random(10),
            'role_id'=>1,
            'is_active'=>1,
            'email'=>str_random(10).'@mail.org',
            'password'=>bcrypt('secret')

        ]);

    }
}
