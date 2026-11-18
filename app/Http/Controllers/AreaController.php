<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use App\Services\TenantContext;

class AreaController extends Controller
{
    protected $context;

    public function __construct(TenantContext $context)
    {
        $this->context = $context;
    }

    public function index()
    {
        // El AreaScope filtra automáticamente las áreas de la empresa activa
        $areas = Area::all(); 
        return view('matriz_riesgo.areas.index', compact('areas'));
    }

    public function create()
    {
        return view('matriz_riesgo.areas.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $area = Area::create([
            'tenant_id' => $this->context->getTenantId(),
            'name' => $request->name,
        ]);

        \Illuminate\Support\Facades\DB::connection('mysql_backend')->table('area_user')->insert([
            'area_id' => $area->id,
            'user_id' => auth()->id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('areas.index')->with('status', 'Área creada y asignada a tu perfil exitosamente.');
    }
}