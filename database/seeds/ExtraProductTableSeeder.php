<?php

use Illuminate\Database\Seeder;

class ExtraProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('brands')->insert([
            'nombre' => 'Marca Generica',
            'shortname' => 'GE',
            'descripcion' => 'Marca generica creada por defecto',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('types')->insert([
            'nombre' => 'Linea Generica',
            'shortname' => 'GE',
            'descripcion' => 'Linea generica creada por defecto',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('materials')->insert([
            'nombre' => 'Material Generico',
            'shortname' => 'GE',
            'descripcion' => 'Material generico creada por defecto',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('stations')->insert([
            'nombre' => 'Estacion Generica',
            'shortname' => 'GE',
            'descripcion' => 'Estacion generica creada por defecto',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
