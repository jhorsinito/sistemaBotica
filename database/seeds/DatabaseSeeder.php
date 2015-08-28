<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
         
         //$this->call(StoreTableSeeder::class);
         //$this->call(RoleTableSeeder::class);
         //$this->call(UserTableSeeder::class);
         //$this->call(monthTableSeeder::class);
         $this->call(methodPaymentsTableSeeder::class);
        //$this->call(PresentationTableSeeder::class);
        //$this->call(AtributeTableSeeder::class);
        //$this->call(StationTableSeeder::class);
        //$this->call(SaleMethodPaymentTableSeeder::class);
        Model::reguard();
    }
}
