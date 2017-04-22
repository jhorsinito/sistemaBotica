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
        
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(PresentacionTableSeeder::class);
        $this->call(TipoProductosTableSeeder::class);
        $this->call(TipoDocumentoTableSeeder::class);
        $this->call(ProveedorTableSeeder::class);
        $this->call(TiendaTableSeeder::class);
        $this->call(AlmacenTableSeeder::class);
        $this->call(LaboratorioTableSeeder::class);
        $this->call(ClienteTableSeeder::class);
        $this->call(MarcaTableSeeder::class);
        $this->call(ComprobanteTableSeeder::class);
        $this->call(CategoriaTableSeeder::class);
        $this->call(MetodoPagoTableSeeder::class);
        $this->call(CompraTableSeeder::class);
        

        Model::reguard();
    }
}