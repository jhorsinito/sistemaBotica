<?php

use Illuminate\Database\Seeder;

class TipoDocumentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        DB::table('tipoDocumentos')->insert([
            'nombreDocumento' => 'RUC',
            'descripcion' => 'Registro Unico de Contribuyente',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('tipoDocumentos')->insert([
            'nombreDocumento' => 'DNI',
            'descripcion' => 'Documento Nacional de Identidad',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('tipoDocumentos')->insert([
            'nombreDocumento' => 'CEDULA',
            'descripcion' => 'Cédula de Extranjería',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
        