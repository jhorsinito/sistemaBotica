<?php

use Illuminate\Database\Seeder;

class ProveedorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('proveedores')->insert([
                'nombreProveedor' => 'Proveedor varios',
                'tipoDocumento_id' => 1,
                'numDocumento'=>44998966,
                'direccion'=>'varios',
                'numCuenta' => '54545454',
                'telefonos' => '545454',
                'email' => 'varios@vencedor.com',
                'webSite' => 'www.varios.com.pe',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
    }
}
