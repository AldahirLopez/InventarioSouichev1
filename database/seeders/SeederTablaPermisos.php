<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//Spatie
use Spatie\Permission\Models\Permission;

class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
            //Tabla roles
            'crear-rol',
            'editar-rol',
            'borrar-rol',

            //Tabla Productos
            'ver-productos',
            'crear-productos',
            'editar-productos',
            'borrar-productos',

            //Tabla Usuarios
            'ver-usuarios',
            'crear-usuarios',
            'editar-usuarios',
            'borrar-usuarios',

            //Tabla Obras
            'ver-obras',
            'crear-obras',
            'editar-obras',
            'borrar-obras',

            //Tabla Operacion y Mantenimiento
            'ver-operacion',
            'crear-operacion',
            'editar-operacion',
            'borrar-operacion',

            //Tabla Diseño y Construccion
            'ver-diseño',
            'crear-diseño',
            'editar-diseño',
            'borrar-diseño'
            
        ];
        foreach($permisos as $permiso){
            Permission::create(['name' => $permiso]);
        }
    }
}
