<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Process;
use Illuminate\Http\Request;
use App\Services\TenantContext;

class ProcessController extends Controller
{
    protected $context;

    public function __construct(TenantContext $context)
    {
        $this->context = $context;
    }

    public function index()
    {
        $processes = Process::with('area')->get();
        return view('matriz_riesgo.processes.index', compact('processes'));
    }

    public function create()
    {
        $areas = Area::all();
        return view('matriz_riesgo.processes.create', compact('areas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // Le indicamos la conexión exacta
            'area_id' => 'required|exists:mysql_backend.areas,id',
            'name'    => 'required|string|max:255',
        ]);

        Process::create([
            'tenant_id' => $this->context->getTenantId(),
            'area_id' => $request->area_id,
            'name' => $request->name,
        ]);

        return redirect()->route('processes.index')->with('status', 'Proceso creado exitosamente.');
    }
}
