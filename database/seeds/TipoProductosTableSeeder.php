<?php

use Illuminate\Database\Seeder;

class TipoProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tipoProductos')->insert([
            'nombre' => 'MEDICAMENTOS',
            'descripcion' => 'Productos Medicinales',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('tipoProductos')->insert([
            'nombre' => 'PERFUMERIA',
            'descripcion' => 'Productos Aromaticos',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('tipoProductos')->insert([
            'nombre' => 'BAZAR',
            'descripcion' => 'Productos Generales',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
