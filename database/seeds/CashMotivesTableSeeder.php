<?php

use Illuminate\Database\Seeder;

class CashMotivesTableSeeder extends Seeder
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
        DB::table('cashMotives')->insert([
            'nombre' => 'Préstamos',
            'observacion' => 'Ingreso por Préstamos',
            'tipo' => '+'
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Ingresos Varios',
            'observacion' => 'Ingresos Varios',
            'tipo' => '+'
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Devoluciones',
            'observacion' => 'Ingresos por Devoluciones',
            'tipo' => '+'
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Saldo Anterior',
            'observacion' => 'Ingreso por Saldo Anterior',
            'tipo' => '+'
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Fondo de Caja',
            'observacion' => 'Ingreso por Fondo de Caja',
            'tipo' => '+'
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Compras',
            'observacion' => 'Pagos de Compras',
            'tipo' => '-'
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Créditos',
            'observacion' => 'Pagos de Créditos',
            'tipo' => '-'
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Adelanto Personal',
            'observacion' => 'Adelanto al personal',
            'tipo' => '-'
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Pago Proveedores',
            'observacion' => 'Pagos de Proveedores',
            'tipo' => '-'
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Gastos Varios',
            'observacion' => 'Gastos Varios',
            'tipo' => '-'
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Viáticos',
            'observacion' => 'Gastos de Viáticos',
            'tipo' => '-'
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Pago crédito',
            'observacion' => 'Pago crédito',
            'tipo' => '+'
        ]);
        DB::table('cashMotives')->insert([
            'nombre' => 'Venta crédito',
            'observacion' => 'Venta crédito',
            'tipo' => '+'
        ]);
    }
}
