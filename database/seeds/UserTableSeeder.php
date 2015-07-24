<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
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
                'name' => 'Javier Jesús Alvarez Montenegro',
                'email' => 'jalvarez@honeysoft.pe',
                'password' => bcrypt('root'),
                'role_id' => 1,
                'store_id' => 1
            ]);



    }
}
