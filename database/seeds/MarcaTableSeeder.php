<?php

use Illuminate\Database\Seeder;

class MarcaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('brands')->insert([
                'nombre' => 'TRIPTAN',
                'shortname' => 'TRTN',
                'descripcion'=>'Creado para los Limones eje',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
       DB::table('brands')->insert([
                'nombre' => 'CROPTER',
                'shortname' => 'CRTP',
                'descripcion'=>'Creado para los tomates eje',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
    }
}