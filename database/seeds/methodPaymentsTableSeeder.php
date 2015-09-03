<?php

use Illuminate\Database\Seeder;

class methodPaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('methodPayments')->insert([
            'nombre' => 'Cheque',
            'descripcion' => 'pago por cheque'
        ]);
        DB::table('methodPayments')->insert([
            'nombre' => 'Cash',
            'descripcion' => 'pago al contado'
        ]);
    }
}
