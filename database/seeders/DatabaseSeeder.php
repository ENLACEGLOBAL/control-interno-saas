<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Tenant;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear el Usuario Administrador (en mysql_auth)
        $user = User::firstOrCreate(
            ['email' => 'ingeniero@omenlaceglobal.co'],
            [
                'name' => 'Omar Fonseca',
                'password' => Hash::make('1104%F**'),
            ]
        );

        // 2. Crear la primera Empresa/Tenant (en mysql_backend)
        $tenant = Tenant::firstOrCreate(
            ['slug' => 'enlace-global-internacional-sas'],
            [
                'name' => 'ENLACE GLOBAL INTERNACIONAL SAS',
                'license_type' => 'premium',
                'is_active' => true,
            ]
        );

        // 3. Vincular el Usuario a la Empresa (en la tabla pivote)
        // Usamos syncWithoutDetaching para evitar duplicados si corremos el seeder varias veces
        $user->tenants()->syncWithoutDetaching([$tenant->id]);

        // 4. Crear el Rol de Super Admin para esta empresa
        $role = Role::firstOrCreate([
            'name' => 'Super Admin',
            'guard_name' => 'web',
            'tenant_id' => $tenant->id,
        ]);

        // 5. Asignar el Rol al Usuario DENTRO DEL CONTEXTO de la empresa
        // Esta función de Spatie le dice al sistema: "La siguiente asignación de rol pertenece a esta empresa"
        setPermissionsTeamId($tenant->id);
        
        $user->assignRole($role);

        $this->command->info('¡Usuario, Empresa y Roles creados con éxito!');
    }
}