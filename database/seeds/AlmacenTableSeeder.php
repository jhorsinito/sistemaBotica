<?php

use Illuminate\Database\Seeder;

class AlmacenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        DB::table('almacenes')->insert([
            'nombreAlmacen' => 'Almacén Central',
            'descripcion' => 'Almacén Principal de La Botica',
            'tienda_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}