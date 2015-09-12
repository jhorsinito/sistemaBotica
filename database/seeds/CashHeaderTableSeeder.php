<?php

use Illuminate\Database\Seeder;

class CashHeaderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('cashMotives')->insert([
            'nombre' => 'Ventas',
            'observacion' => 'Ventas del día',
            'tipo' => '+'
        ]);
    }
}
