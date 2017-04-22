<?php

use Illuminate\Database\Seeder;

class ClienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        DB::table('clientes')->insert([
            'nombreCliente' => 'Pedro Picapiedras',
            'empresa' => 'LOS PICAPIEDRAS',
            'direccion' => 'Los picapiedras del Perú 215241',
            'ruc' => '54545787521',
            'dni' => 44879653,
            'codigo' => 'LSPPDS2017',
            'fechaNac' => '27/12/1980',
            'genero' => 'Masculino',
            'tel_fijo' => '456872',
            'tel_movil' => '954873621',
            'email' => 'picapiedra@gmail.com',
            'webSite' => 'www.picapiedra.com',
            'notas' => 'Los picapiedros',

            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}