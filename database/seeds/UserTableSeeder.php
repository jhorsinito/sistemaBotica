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
        
            DB::table('users')->insert([
                'name' => 'soporte',
                'email' => 'soporte@vencedor.com',
                'password' => bcrypt('1234567'),
                'estado' => 1,
                'role_id' => 3,
                'image' => '/images/users/default.jpg',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);

            DB::table('users')->insert([
                'name' => 'Isaac Sanchez Fernandez',
                'email' => 'isanchezf26@vencedor.com',
                'password' => bcrypt('1234567'),
                'estado' => 1,
                'role_id' => 1,
                'image' => '/images/users/Isaac.jpg',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);

            DB::table('users')->insert([
                'name' => 'Eduard Bringas Vargas',
                'email' => 'ebringasv@vencedor.com',
                'password' => bcrypt('1234567'),
                'estado' => 1,
                'role_id' => 2,
                'image' => '/images/users/default.jpg',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);



    }
}