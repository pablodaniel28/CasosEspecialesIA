<?php

namespace Database\Seeders;

use App\Models\Carrera;
use App\Models\Director;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Crear permisos
        Permission::firstOrCreate(['name' => 'ver']);
        Permission::firstOrCreate(['name' => 'editar']);
        Permission::firstOrCreate(['name' => 'borrar']);

        // Crear roles y asignar permisos
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo(['ver', 'editar', 'borrar']);

        $directorRole = Role::firstOrCreate(['name' => 'director']);
        $directorRole->givePermissionTo(['ver', 'editar']);

        $estudianteRole = Role::firstOrCreate(['name' => 'estudiante']);
        $estudianteRole->givePermissionTo(['ver']);

        // Crear carreras
        $carreraSistemas = Carrera::firstOrCreate([
            'nombre' => 'Ingeniería en Sistemas',
            'codigo' => '187-4'
        ]);

        $carreraInformatica = Carrera::firstOrCreate([
            'nombre' => 'Ingeniería Informática',
            'codigo' => '187-3'
        ]);

        // Crear usuarios y asignar roles
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('12345678'),
            ]
        );
        $adminUser->assignRole($adminRole);

        $sistemasUser = User::firstOrCreate(
            ['email' => 'sistemas@gmail.com'],
            [
                'name' => 'sistemas',
                'password' => Hash::make('12345678'),
                'carrera_id' => $carreraSistemas->id,
            ]
        );
        $sistemasUser->assignRole($estudianteRole);

        $infoUser = User::firstOrCreate(
            ['email' => 'informatica@gmail.com'],
            [
                'name' => 'info',
                'password' => Hash::make('12345678'),
                'carrera_id' => $carreraInformatica->id,
            ]
        );
        $infoUser->assignRole($estudianteRole);

        $directorUser = User::firstOrCreate(
            ['email' => 'junnior@gmail.com'],
            [
                'name' => 'junnior villagomez',
                'password' => Hash::make('12345678'),
                'carrera_id' => $carreraInformatica->id,
            ]
        );
        $directorUser->assignRole($directorRole);

        // Crear director asociado al usuario y carrera
        Director::firstOrCreate([
            'nombre' => 'Junnior Director',
            'codigo' => 123456,
            'celular' => 78541236,
            'carrera_id' => $carreraInformatica->id,
            'usuario_id' => $directorUser->id,
        ]);
    }
}
