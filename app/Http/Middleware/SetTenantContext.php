<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\TenantContext;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // <-- AGREGADO PARA LEER LA TABLA PIVOTE

class SetTenantContext
{
    protected TenantContext $context;

    // Inyectamos nuestro Singleton
    public function __construct(TenantContext $context)
    {
        $this->context = $context;
    }

    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && session()->has('active_tenant_id')) {
            $tenantId = session('active_tenant_id');
            
            // Buscamos la empresa en la base de datos
            $tenant = Tenant::find($tenantId);

            if ($tenant) {
                // 1. Guardamos la empresa en nuestro Singleton
                $this->context->setTenant($tenant);

                // 2. MAGIA DE SPATIE: Le decimos a la librería de roles en qué empresa estamos
                setPermissionsTeamId($tenant->id);

                // 3. Verificamos si tiene el permiso maestro para verlo todo (Spatie)
                try {
                    $this->context->setGlobalAccess(Auth::user()->hasPermissionTo('ver_todo'));
                } catch (\Spatie\Permission\Exceptions\PermissionDoesNotExist $e) {
                    // Si el permiso no existe, simplemente le negamos el acceso global
                    $this->context->setGlobalAccess(false);
                }

                // 4. Buscamos en la tabla pivote a qué áreas tiene acceso este usuario
                $areaIds = DB::connection('mysql_backend')
                    ->table('area_user')
                    ->where('user_id', Auth::id())
                    ->pluck('area_id')
                    ->toArray();

                // 5. Se las inyectamos al cerebro (TenantContext) para el AreaScope
                $this->context->setAllowedAreas($areaIds);
            }
        }

        return $next($request);
    }
}