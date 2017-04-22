<?php

use Illuminate\Database\Seeder;

class TiendaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        DB::table('tiendas')->insert([
            'nombreTienda' => 'Botica Vencedor',
            'razonSocial' => 'Botica Vencedor SRL',
            'ruc' => '54455454554',
            'direccion' => 'Fernando Belaunde 550',
            'distrito' => 'Chiclayo',
            'provincia' => 'Chiclayo',
            'departamento' => 'Lambayeque',
            'pais' => 'Perú',
            'email' => 'boticavencedor@gmail.com',
            'telMovil' => '987465557',
            'telFijo' => '547454',
            'webSite' => 'www.boticavencedor.com',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
        