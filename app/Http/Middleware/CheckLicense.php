<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\TenantContext;

class CheckLicense
{
    protected TenantContext $context;

    public function __construct(TenantContext $context)
    {
        $this->context = $context;
    }

    /**
     * Maneja la petición entrante.
     * El parámetro $module se lo pasaremos desde la ruta (Ej: 'facturacion')
     */
    public function handle(Request $request, Closure $next, string $module): Response
    {
        // 1. Verificamos si hay una empresa activa en el contexto
        if (!$this->context->hasTenant()) {
            return redirect()->route('dashboard')->with('error', 'Debes seleccionar una empresa primero.');
        }

        $tenant = $this->context->getTenant();
        $licenseType = $tenant->license_type; // Ej: 'premium'

        // 2. Buscamos qué licencias están permitidas para este módulo en el config
        $allowedLicenses = config("saas.modules.{$module}");

        // 3. Si el módulo no existe en el config, o la licencia actual no está en la lista de permitidas
        if (!$allowedLicenses || !in_array($licenseType, $allowedLicenses)) {
            // Abortamos con un error 403 (Prohibido)
            abort(403, 'La licencia actual (' . strtoupper($licenseType) . ') no incluye acceso al módulo: ' . $module);
        }

        return $next($request);
    }
}