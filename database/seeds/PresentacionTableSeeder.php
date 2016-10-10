<?php

use Illuminate\Database\Seeder;

class PresentacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('presentaciones')->insert([
            'nombre' => 'Unidades',
            'shortname' => 'Un.',
            'descripcion' => '',
            'base' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('presentaciones')->insert([
            'nombre' => 'Kilogramos',
            'shortname' => 'Kg.',
            'descripcion' => '',
            'base' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('presentaciones')->insert([
            'nombre' => 'Litros',
            'shortname' => 'Lt.',
            'descripcion' => '',
            'base' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
