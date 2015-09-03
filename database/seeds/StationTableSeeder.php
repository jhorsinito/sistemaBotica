<?php

use Illuminate\Database\Seeder;

class StationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('stations')->insert([
            'nombre' => 'Verano',
            'shortname' => 'VER',
            'descripcion' => ''
        ]);
        DB::table('stations')->insert([
            'nombre' => 'Invierno',
            'shortname' => 'INV',
            'descripcion' => ''
        ]);
        DB::table('stations')->insert([
            'nombre' => 'Otoño',
            'shortname' => 'OTO',
            'descripcion' => ''
        ]);
        DB::table('stations')->insert([
            'nombre' => 'Primavera',
            'shortname' => 'PRI',
            'descripcion' => ''
        ]);
    }
}
