<?php

use Illuminate\Database\Seeder;

class ProfesionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
            DB::table('profesiones')->insert([
                'nombre' => 'Otra',
                'descripcion' => 'Otra',
                'orden' =>  'zzzzzzzzzz'
            ]);


    }
}