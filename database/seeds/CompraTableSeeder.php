<?php

use Illuminate\Database\Seeder;

class CompraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('compras')->insert([
                'proveedor_id' => 1,
                'user_id' => 2,
                'metodoPago_id' => 1,
                'comprobante_id' => 1,
                'observaciones' => 'Ninguna',
                'estado' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
       DB::table('compras')->insert([
                'proveedor_id' => 1,
                'user_id' => 2,
                'metodoPago_id' => 1,
                'comprobante_id' => 3,
                'estado' => 0,
                'observaciones' => 'Ninguna',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
    }
}