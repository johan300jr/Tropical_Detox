<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//Spatie
//Spatie
use Spatie\Permission\Models\Permission;

class seederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $permisos = [
            //tabla roles
            'dashboard',
            'roles',
            'usuarios',
            'clientes',
            'categoria de productos',
            'productos',
            'insumos',
            'pedidos',
            'ventas',
        ];
        //añadir los permisos a la tabla
        foreach($permisos as $permiso){
            Permission::create(['name' => $permiso]);
        }
        //
    }
}
