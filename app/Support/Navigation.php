<?php

namespace App\Support;

use App\Services\TenantContext;
use Illuminate\Support\Facades\Route;

/**
 * Fuente única de verdad para la navegación de la aplicación:
 * la barra lateral y las migas de pan se generan a partir de aquí.
 */
class Navigation
{
    /**
     * Íconos (trazos SVG 24x24, estilo línea) reutilizados en toda la interfaz.
     */
    public const ICONS = [
        'home'     => '<path d="m3 10 9-7 9 7v10a2 2 0 0 1-2 2h-4v-7H9v7H5a2 2 0 0 1-2-2z"/>',
        'building' => '<path d="M3 21h18"/><path d="M5 21V7l8-4v18"/><path d="M19 21V11l-6-4"/><path d="M9 9h.01M9 13h.01M9 17h.01"/>',
        'flow'     => '<rect x="3" y="3" width="6" height="6" rx="1"/><rect x="15" y="15" width="6" height="6" rx="1"/><path d="M6 9v3a3 3 0 0 0 3 3h6"/>',
        'grid'     => '<rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/>',
        'alert'    => '<path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><path d="M12 9v4"/><path d="M12 17h.01"/>',
        'shield'   => '<path d="M12 3l7 3v5c0 4.5-3 8.2-7 10-4-1.8-7-5.5-7-10V6l7-3z"/><path d="m9 12 2 2 4-4"/>',
        'search'   => '<circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/>',
        'clipboard'=> '<rect x="6" y="4" width="12" height="17" rx="2"/><path d="M9 4V3h6v1"/><path d="M9 11h6M9 15h4"/>',
        'users'    => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
        'crown'    => '<path d="m3 7 4 4 5-7 5 7 4-4-2 12H5z"/>',
        'key'      => '<circle cx="7.5" cy="15.5" r="4.5"/><path d="m10.7 12.3 9.3-9.3"/><path d="m16 7 3 3"/>',
        'user'     => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
        'lock'     => '<rect x="4" y="11" width="16" height="10" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/>',
        'plus'     => '<path d="M12 5v14M5 12h14"/>',
        'logout'   => '<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="m16 17 5-5-5-5"/><path d="M21 12H9"/>',
        'bell'     => '<path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/>',
        'chevron'  => '<path d="m9 18 6-6-6-6"/>',
        'switch'   => '<path d="m7 15 5 5 5-5"/><path d="m7 9 5-5 5 5"/>',
        'check'    => '<path d="M20 6 9 17l-5-5"/>',
        'inbox'    => '<path d="M22 12h-6l-2 3h-4l-2-3H2"/><path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/>',
        'arrow-left' => '<path d="M19 12H5"/><path d="m12 19-7-7 7-7"/>',
        'menu'     => '<path d="M4 6h16M4 12h16M4 18h16"/>',
        'x'        => '<path d="M18 6 6 18M6 6l12 12"/>',
    ];

    public static function icon(string $name): string
    {
        return self::ICONS[$name] ?? self::ICONS['grid'];
    }

    /**
     * Secciones de la barra lateral.
     * - route:   nombre de la ruta destino
     * - active:  patrones de nombres de ruta que marcan el ítem como activo
     * - license: módulo de config/saas.php requerido (se muestra con candado si no aplica)
     */
    public static function sections(): array
    {
        $user = auth()->user();

        $sections = [
            [
                'label' => null,
                'items' => [
                    ['label' => 'Inicio', 'route' => 'dashboard', 'active' => ['dashboard'], 'icon' => 'home'],
                ],
            ],
            [
                'label' => 'Estructura organizacional',
                'items' => [
                    ['label' => 'Direcciones / Áreas', 'route' => 'areas.index', 'active' => ['areas.*'], 'icon' => 'building'],
                    ['label' => 'Mapa de procesos', 'route' => 'processes.index', 'active' => ['processes.*'], 'icon' => 'flow'],
                ],
            ],
            [
                'label' => 'Gestión de riesgos',
                'items' => [
                    ['label' => 'Matriz de calor', 'route' => 'matrix.dashboard', 'active' => ['matrix.*'], 'icon' => 'grid'],
                    ['label' => 'Inventario de riesgos', 'route' => 'risks.index', 'active' => ['risks.*'], 'icon' => 'alert'],
                    ['label' => 'Controles mitigantes', 'route' => 'controls.index', 'active' => ['controls.*'], 'icon' => 'shield'],
                ],
            ],
            [
                'label' => 'Auditoría',
                'items' => [
                    ['label' => 'Consultas generales', 'route' => 'modulo.consultas', 'active' => ['modulo.consultas'], 'icon' => 'search', 'license' => 'consultas_basicas'],
                    ['label' => 'Auditoría avanzada', 'route' => 'modulo.auditoria', 'active' => ['modulo.auditoria'], 'icon' => 'clipboard', 'license' => 'auditoria_avanzada'],
                ],
            ],
            [
                'label' => 'Administración',
                'items' => [
                    ['label' => 'Accesos por área', 'route' => 'tenant-users.index', 'active' => ['tenant-users.*'], 'icon' => 'users'],
                ],
            ],
        ];

        if ($user && $user->is_superadmin) {
            $sections[] = [
                'label' => 'Plataforma SaaS',
                'items' => [
                    ['label' => 'Centro de comando', 'route' => 'saas.dashboard', 'active' => ['saas.dashboard', 'saas.tenants.*', 'saas.users.*'], 'icon' => 'crown'],
                    ['label' => 'Roles y permisos', 'route' => 'saas.roles.index', 'active' => ['saas.roles.*'], 'icon' => 'key'],
                ],
            ];
        }

        foreach ($sections as &$section) {
            foreach ($section['items'] as &$item) {
                $item['url'] = Route::has($item['route']) ? route($item['route']) : '#';
                $item['is_active'] = request()->routeIs(...$item['active']);
                $item['locked'] = isset($item['license']) && ! self::licenseAllows($item['license']);
            }
        }

        return $sections;
    }

    /**
     * Replica la lógica del middleware CheckLicense para anticipar accesos en el menú.
     */
    public static function licenseAllows(string $module): bool
    {
        $context = app(TenantContext::class);

        if (! $context->hasTenant()) {
            return false;
        }

        $allowed = config("saas.modules.{$module}");

        return is_array($allowed) && in_array($context->getTenant()->license_type, $allowed);
    }

    /**
     * Migas de pan derivadas del nombre de la ruta actual.
     * Devuelve una lista de ['label' => ..., 'url' => ?string].
     */
    public static function breadcrumbs(): array
    {
        $name = optional(request()->route())->getName();

        $map = [
            'dashboard'            => [],
            'areas.index'          => [['Estructura'], ['Direcciones / Áreas']],
            'areas.create'         => [['Estructura'], ['Direcciones / Áreas', 'areas.index'], ['Nueva área']],
            'processes.index'      => [['Estructura'], ['Mapa de procesos']],
            'processes.create'     => [['Estructura'], ['Mapa de procesos', 'processes.index'], ['Nuevo proceso']],
            'matrix.dashboard'     => [['Gestión de riesgos'], ['Matriz de calor']],
            'risks.index'          => [['Gestión de riesgos'], ['Inventario de riesgos']],
            'risks.create'         => [['Gestión de riesgos'], ['Inventario de riesgos', 'risks.index'], ['Registrar riesgo']],
            'controls.index'       => [['Gestión de riesgos'], ['Controles mitigantes']],
            'controls.create'      => [['Gestión de riesgos'], ['Controles mitigantes', 'controls.index'], ['Vincular control']],
            'modulo.consultas'     => [['Auditoría'], ['Consultas generales']],
            'modulo.auditoria'     => [['Auditoría'], ['Auditoría avanzada']],
            'tenant-users.index'   => [['Administración'], ['Accesos por área']],
            'tenant-users.edit'    => [['Administración'], ['Accesos por área', 'tenant-users.index'], ['Asignar áreas']],
            'profile.edit'         => [['Mi perfil']],
            'saas.dashboard'       => [['Plataforma SaaS'], ['Centro de comando']],
            'saas.tenants.create'  => [['Plataforma SaaS'], ['Centro de comando', 'saas.dashboard'], ['Nueva empresa']],
            'saas.users.create'    => [['Plataforma SaaS'], ['Centro de comando', 'saas.dashboard'], ['Nuevo usuario']],
            'saas.roles.index'     => [['Plataforma SaaS'], ['Roles y permisos']],
        ];

        $crumbs = [['label' => 'Inicio', 'url' => route('dashboard')]];

        foreach ($map[$name] ?? [] as $crumb) {
            $crumbs[] = [
                'label' => $crumb[0],
                'url'   => isset($crumb[1]) && Route::has($crumb[1]) ? route($crumb[1]) : null,
            ];
        }

        return $crumbs;
    }
}
