<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{
    /**
     * Cambia la empresa activa en la sesión del usuario.
     */
    public function switch(Request $request)
    {
        // 1. Validamos que nos envíen un ID
        $request->validate([
            'tenant_id' => 'required|integer',
        ]);

        $tenantId = $request->tenant_id;
        $user = Auth::user();

        // 2. Seguridad: Verificamos que el usuario realmente pertenezca a esta empresa
        $tenant = $user->tenants()->find($tenantId);

        if (!$tenant) {
            abort(403, 'Acceso denegado: No perteneces a esta empresa.');
        }

        // 3. Guardamos los datos de la empresa en la sesión
        session()->put('active_tenant_id', $tenant->id);
        session()->put('tenant_name', $tenant->name);

        // 4. Redirigimos de vuelta a la página donde estaba el usuario
        return back()->with('status', 'Has cambiado a la empresa: ' . $tenant->name);
    }
}