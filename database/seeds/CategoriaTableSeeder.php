<?php

use Illuminate\Database\Seeder;

class CategoriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        DB::table('types')->insert([
            'nombre' => 'Cosmeticos',
            'shortname' => 'COSMETI',
            'descripcion' => 'Productos de belleza',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('types')->insert([
            'nombre' => 'Desinfectantes',
            'shortname' => 'DESINFE',
            'descripcion' => 'Productos de Limpieza',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('types')->insert([
            'nombre' => 'Desinflamantes',
            'shortname' => 'DESINFL',
            'descripcion' => 'Productos de Dolores',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('types')->insert([
            'nombre' => 'Desintoxicantes',
            'shortname' => 'DESINTO',
            'descripcion' => 'Productos de desintoxicacion',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

    }
}