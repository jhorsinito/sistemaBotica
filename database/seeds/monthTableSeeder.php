<?php

use Illuminate\Database\Seeder;

class monthTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


            DB::table('months')->insert([
            'month' => 'Enero'
        ]);
        DB::table('months')->insert([
            'month' => 'Febrero'
        ]);
        DB::table('months')->insert([
            'month' => 'Marzo'
        ]);
        DB::table('months')->insert([
            'month' => 'Abril'
        ]);
        DB::table('months')->insert([
            'month' => 'Mayo'
        ]);
        DB::table('months')->insert([
            'month' => 'Junio'
        ]);
        DB::table('months')->insert([
            'month' => 'Julio'
        ]);
        DB::table('months')->insert([
            'month' => 'Agosto'
        ]);
        DB::table('months')->insert([
            'month' => 'Setiembre'
        ]);
        DB::table('months')->insert([
            'month' => 'Octubre'
        ]);
        DB::table('months')->insert([
            'month' => 'Noviembre'
        ]);
        DB::table('months')->insert([
            'month' => 'Diciembre'
        ]);

    }
}