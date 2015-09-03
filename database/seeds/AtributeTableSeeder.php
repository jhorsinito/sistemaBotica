<?php

use Illuminate\Database\Seeder;

class AtributeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('atributes')->insert([
            'nombre' => 'Color',
            'shortname' => 'COL',
            'descripcion' => ''
        ]);
        DB::table('atributes')->insert([
            'nombre' => 'Talla',
            'shortname' => 'TAL',
            'descripcion' => ''
        ]);
        DB::table('atributes')->insert([
            'nombre' => 'Taco',
            'shortname' => 'TAC',
            'descripcion' => ''
        ]);
        DB::table('atributes')->insert([
            'nombre' => 'Material',
            'shortname' => 'MAT',
            'descripcion' => ''
        ]);
    }
}
