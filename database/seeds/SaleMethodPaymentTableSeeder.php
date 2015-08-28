<?php

use Illuminate\Database\Seeder;

class SaleMethodPaymentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('saleMethodPayments')->insert([
            'nombre' => 'Efectivo',
            'descripcion' => 'Dinero Efectivo.',
        ]);
        DB::table('saleMethodPayments')->insert([
            'nombre' => 'Visa',
            'descripcion' => 'Tarjeta Visa',
        ]);
        DB::table('saleMethodPayments')->insert([
            'nombre' => 'MasterCard',
            'descripcion' => 'Tarjeta MasterCard',
        ]);
    }
}