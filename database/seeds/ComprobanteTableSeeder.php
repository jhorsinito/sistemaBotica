<?php

use Illuminate\Database\Seeder;

class ComprobanteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        DB::table('comprobantes')->insert([
            'nombreComprobante' => 'Boleta',
            'descripcion' => 'No Incluye IGV',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('comprobantes')->insert([
            'nombreComprobante' => 'Factura',
            'descripcion' => 'Incluye IGV',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('comprobantes')->insert([
            'nombreComprobante' => 'Ticket',
            'descripcion' => 'No Incluye IGV',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('comprobantes')->insert([
            'nombreComprobante' => 'Guia de Remisioń',
            'descripcion' => 'Incluye IGV',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}