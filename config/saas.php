<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Mapa de Acceso a Módulos por Licencia
    |--------------------------------------------------------------------------
    | Define aquí qué licencias ('basic', 'premium', 'enterprise')
    | tienen acceso a los diferentes módulos de la aplicación.
    */
    'modules' => [
        // Módulos básicos
        'dashboard' => ['basic', 'premium', 'enterprise'],
        'reportes_basicos' => ['basic', 'premium', 'enterprise'],
        
        // Módulos premium
        'facturacion' => ['premium', 'enterprise'],
        'reportes_avanzados' => ['premium', 'enterprise'],
        
        // Módulos exclusivos
        'api_externa' => ['enterprise'],

        'consultas_basicas' => ['basic', 'premium', 'enterprise'],
        'auditoria_avanzada' => ['premium', 'enterprise'],
    ],
];