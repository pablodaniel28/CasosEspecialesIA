<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Permission::create(['name' => 'ver usuarios']);
        Permission::create(['name' => 'editar usuarios']);
        Permission::create(['name' => 'borrar usuarios']);

        // Crear roles y asignar permisos
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(['ver usuarios', 'editar usuarios', 'borrar usuarios']);

        $estudiante = Role::create(['name' => 'estudiante']);
        $estudiante->givePermissionTo(['ver usuarios']);

        // Crear usuarios y asignarles roles
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('12345678'),
            ]
        );
        $admin->assignRole('admin');

        // Crear usuarios y asignarles roles
        $admin = User::firstOrCreate(
            ['email' => 'estudiante@gmail.com'],
            [
                'name' => 'estudiante',
                'password' => Hash::make('12345678'),
            ]
        );
        $admin->assignRole('estudiante');
    }
}
