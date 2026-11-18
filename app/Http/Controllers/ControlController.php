<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Risk;
use App\Models\Control;
use Illuminate\Http\Request;
use App\Services\TenantContext;

class ControlController extends Controller
{
    protected $context;

    public function __construct(TenantContext $context)
    {
        $this->context = $context;
    }

    public function index()
    {
        $controls = Control::with('risk', 'area')->get();
        return view('matriz_riesgo.controls.index', compact('controls'));
    }

    public function create()
    {
        $areas = Area::all();
        $risks = Risk::all();
        return view('matriz_riesgo.controls.create', compact('areas', 'risks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'area_id'             => 'required|exists:mysql_backend.areas,id',
            'risk_id'             => 'required|exists:mysql_backend.risks,id',
            'name'                => 'required|string|max:255',
            'description'         => 'nullable|string',
            'type'                => 'required|in:Preventivo,Detectivo,Correctivo',
            'formal_score'        => 'required|integer|between:0,15',
            'application_score'   => 'required|integer|between:0,20',
            'effectiveness_score' => 'required|integer|between:0,65',
        ]);

        Control::create(array_merge($request->all(), [
            'tenant_id' => $this->context->getTenantId()
        ]));

        return redirect()->route('controls.index')->with('status', 'Control mitigante registrado exitosamente.');
    }
}