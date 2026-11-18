<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tenant;
use App\Models\Role;
use App\Models\Permision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SaasController extends Controller
{
    public function index()
    {
        // Traemos todas las empresas y todos los usuarios
        $tenants = Tenant::withCount('users')->get(); // Asume que tienes relación users() en Tenant
        $users = User::orderBy('created_at', 'desc')->get();

        return view('saas.dashboard', compact('tenants', 'users'));
    }

    public function createTenant()
    {
        return view('saas.tenants.create');
    }

    public function createUser()
    {
        $tenants = Tenant::all();

        // 1. Verificamos si hay roles en el backend. Si no hay ninguno, los autogeneramos
        $rolesExist = DB::connection('mysql_backend')->table('roles')->exists();
        if (!$rolesExist) {
            $rolesParaCrear = [
                ['name' => 'administrador', 'guard_name' => 'web'],
                ['name' => 'gestor', 'guard_name' => 'web'],
                ['name' => 'auditor', 'guard_name' => 'web'],
            ];
            DB::connection('mysql_backend')->table('roles')->insert($rolesParaCrear);
        }

        // Traemos los roles del backend
        $roles = DB::connection('mysql_backend')->table('roles')->get();

        return view('saas.users.create', compact('tenants', 'roles'));
    }

    public function storeTenant(Request $request)
    {
        // 1. Validamos que venga el nombre y el tipo de licencia
        $request->validate([
            'name' => 'required|string|max:255|unique:mysql_backend.tenants,name',
            'license_type' => 'required|string'
        ]);

        // 2. Creamos la empresa en el backend con todos los parámetros
        Tenant::create([
            'name'         => $request->name,
            'slug'         => \Illuminate\Support\Str::slug($request->name), // Generado automático
            'license_type' => $request->license_type, // Viene del select
            'is_active'    => true, // Lo activamos por defecto al nacer
        ]);

        return redirect()->route('saas.dashboard')->with('status', 'Empresa y entorno SaaS registrados exitosamente.');
    }
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:mysql_auth.users,email',
            'password' => 'required|min:8',
            'tenant_ids' => 'required|array|min:1',
            'tenant_ids.*' => 'exists:mysql_backend.tenants,id',
            'role_names' => 'required|array' // Validamos que sea el arreglo de roles por empresa
        ]);

        // 1. Creamos al usuario global en Auth
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 2. Procesamos cada empresa seleccionada
        foreach ($request->tenant_ids as $tenantId) {
            // Obtenemos el rol específico asignado a esta empresa en el formulario
            $rolParaEstaEmpresa = $request->role_names[$tenantId] ?? null;

            if ($rolParaEstaEmpresa) {
                // Vincular en la tabla pivote del backend
                DB::connection('mysql_backend')->table('tenant_user')->insert([
                    'tenant_id' => $tenantId,
                    'user_id' => $user->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // 3. Fijamos el contexto en Spatie para esta iteración y asignamos SU rol correspondiente
                setPermissionsTeamId($tenantId);
                $user->assignRole($rolParaEstaEmpresa);
            }
        }

        return redirect()->route('saas.dashboard')->with('status', 'Usuario configurado con roles específicos por entorno empresarial.');
    }
    // ==========================================
    // MÓDULO DE ROLES Y PERMISOS (SUPERADMIN)
    // ==========================================

    public function rolesIndex()
    {
        // Traemos todos los roles con sus permisos asociados
        $roles = Role::with('permissions')->get();
        // Traemos el catálogo completo de permisos
        $permissions = Permision::all();

        return view('saas.roles.index', compact('roles', 'permissions'));
    }

    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:mysql_backend.roles,name'
        ]);

        Role::create([
            'name' => strtolower(str_replace(' ', '_', $request->name)),
            'guard_name' => 'web'
        ]);

        return redirect()->back()->with('status', 'Nuevo Rol Maestro creado con éxito.');
    }

    public function storePermission(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:mysql_backend.permissions,name'
        ]);

        Permision::create([
            'name' => strtolower(str_replace(' ', '_', $request->name)),
            'guard_name' => 'web'
        ]);

        return redirect()->back()->with('status', 'Nuevo Permiso registrado en el sistema.');
    }

    public function syncRolePermissions(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        // Spatie sincroniza automáticamente la tabla pivote de roles_has_permissions
        // Si $request->permissions está vacío, quitará todos los permisos del rol.
        $role->syncPermissions($request->permissions ?? []);

        return redirect()->back()->with('status', 'Matriz de permisos actualizada para el rol: ' . strtoupper($role->name));
    }
}
