<?php


namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TenantUserController extends Controller
{
    public function index()
    {
        // 1. Obtenemos el ID de la empresa en la que estás logueado actualmente
        $tenantId = app(\App\Services\TenantContext::class)->getTenantId();

        // 2. Buscamos los usuarios conectándonos estrictamente al BACKEND
        // (Asegúrate de que el nombre 'tenant_user' coincida con tu tabla del backend)
        $userIds = \Illuminate\Support\Facades\DB::connection('mysql_backend')
            ->table('tenant_user') 
            ->where('tenant_id', $tenantId)
            ->pluck('user_id');

        // 3. Traemos de la base de datos principal (auth) únicamente a esos usuarios
        $users = User::whereIn('id', $userIds)->get();

        return view('matriz_riesgo.users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        // Obtenemos las áreas de la empresa actual (El AreaScope ya las filtra solas)
        $areas = Area::all();

        // Consultamos a qué áreas ya tiene acceso este usuario
        $assignedAreaIds = DB::connection('mysql_backend')
            ->table('area_user')
            ->where('user_id', $user->id)
            ->pluck('area_id')
            ->toArray();

        return view('matriz_riesgo.users.edit', compact('user', 'areas', 'assignedAreaIds'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'areas' => 'nullable|array',
            'areas.*' => 'exists:mysql_backend.areas,id'
        ]);

        $selectedAreas = $request->areas ?? [];

        // 1. Obtenemos los IDs de las áreas de la empresa actual
        $areaIdsDelTenant = Area::pluck('id')->toArray();

        // 2. Limpiamos los accesos viejos del usuario (solo en las áreas de esta empresa)
        if (!empty($areaIdsDelTenant)) {
            DB::connection('mysql_backend')
                ->table('area_user')
                ->where('user_id', $user->id)
                ->whereIn('area_id', $areaIdsDelTenant)
                ->delete();
        }

        // 3. Insertamos los nuevos accesos seleccionados en el formulario
        $insertData = [];
        foreach ($selectedAreas as $areaId) {
            $insertData[] = [
                'area_id' => $areaId,
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (!empty($insertData)) {
            DB::connection('mysql_backend')->table('area_user')->insert($insertData);

            // DISPARAR NOTIFICACIÓN: Buscamos los nombres de las áreas asignadas para avisarle al usuario
            $nombresAreas = Area::whereIn('id', $selectedAreas)->pluck('name')->implode(', ');
            if (!empty($nombresAreas)) {
                $user->notify(new \App\Notifications\AreaAssignedNotification($nombresAreas));
            }
        }

        return redirect()->route('tenant-users.index')
            ->with('status', 'Accesos actualizados y notificación enviada exitosamente.');
    }
}
