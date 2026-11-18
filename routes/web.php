<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenantController;

use App\Http\Controllers\AreaController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\RiskController;
use App\Http\Controllers\ControlController;
use App\Http\Controllers\MatrixDashboardController;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/consultas', function () {
        return view('modulos.consultas');
    })->middleware('license:consultas_basicas')->name('modulo.consultas');

    // Ruta de Auditoría Avanzada (Protegida por Auth y verificador de licencia)
    Route::get('/auditoria', function () {
        return view('modulos.auditoria');
    })->middleware('license:auditoria_avanzada')->name('modulo.auditoria');

    // Rutas de Configuración del Universo de Negocio
    Route::resource('areas', AreaController::class)->only(['index', 'create', 'store']);
    Route::resource('processes', ProcessController::class)->only(['index', 'create', 'store']);
    
    // Rutas de Evaluación Temática (Matriz COSO)
    Route::resource('risks', RiskController::class)->only(['index', 'create', 'store']);
    Route::resource('controls', ControlController::class)->only(['index', 'create', 'store']);
    
    // El Tablero Principal con los mapas dinámicos
    Route::get('/matriz-calor', [MatrixDashboardController::class, 'index'])->name('matrix.dashboard');
    //roles y usuarios
    Route::resource('tenant-users', \App\Http\Controllers\TenantUserController::class)->only(['index', 'edit', 'update']);

    Route::post('/notifications/read', function() { auth()->user()->unreadNotifications->markAsRead(); return back(); })->name('notifications.read');
});

Route::middleware(['auth', 'superadmin'])->prefix('saas')->name('saas.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\SaasController::class, 'index'])->name('dashboard');
    Route::get('/tenants/create', [\App\Http\Controllers\SaasController::class, 'createTenant'])->name('tenants.create');
    Route::post('/tenants', [\App\Http\Controllers\SaasController::class, 'storeTenant'])->name('tenants.store');
    Route::get('/users/create', [\App\Http\Controllers\SaasController::class, 'createUser'])->name('users.create');
    Route::post('/users', [\App\Http\Controllers\SaasController::class, 'storeUser'])->name('users.store');
    
    // Rutas para Roles y Permisos
    Route::get('/roles', [\App\Http\Controllers\SaasController::class, 'rolesIndex'])->name('roles.index');
    Route::post('/roles', [\App\Http\Controllers\SaasController::class, 'storeRole'])->name('roles.store');
    Route::post('/permissions', [\App\Http\Controllers\SaasController::class, 'storePermission'])->name('permissions.store');
    Route::post('/roles/{id}/permissions', [\App\Http\Controllers\SaasController::class, 'syncRolePermissions'])->name('roles.permissions.sync');
});


require __DIR__.'/auth.php';

Route::post('/tenant/switch', [TenantController::class, 'switch'])
    ->middleware('auth')
    ->name('tenant.switch');