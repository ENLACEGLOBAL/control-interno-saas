<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Process;
use App\Models\Risk;
use Illuminate\Http\Request;
use App\Services\TenantContext;

class RiskController extends Controller
{
    protected $context;

    public function __construct(TenantContext $context)
    {
        $this->context = $context;
    }

    public function index()
    {
        $risks = Risk::with('process.area')->get();
        return view('matriz_riesgo.risks.index', compact('risks'));
    }

    public function create()
    {
        $areas = Area::all();
        $processes = Process::all();
        return view('matriz_riesgo.risks.create', compact('areas', 'processes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'area_id'     => 'required|exists:mysql_backend.areas,id',
            'process_id'  => 'required|exists:mysql_backend.processes,id',
            'code'        => 'required|string|max:20',
            'category' => 'required|string',
            'description' => 'required|string',
            'cause'       => 'nullable|string',
            'consequence' => 'nullable|string',
            'probability' => 'required|integer|between:1,5',
            'impact'      => 'required|integer|between:1,5',
        ]);

        Risk::create(array_merge($request->all(), [
            'tenant_id' => $this->context->getTenantId()
        ]));

        return redirect()->route('risks.index')->with('status', 'Riesgo registrado exitosamente.');
    }
    public function getResidualProbabilityAttribute(): int {
        // Los preventivos mitigan probabilidad. Los detectivos ayudan un 50%.
        $prevScore = $this->controls->where('type', 'Preventivo')->sum('total_score');
        $detScore = $this->controls->where('type', 'Detectivo')->sum('total_score');
        
        $mitigationPct = min(100, $prevScore + ($detScore * 0.5)) / 100;
        return max(1, round($this->probability * (1 - $mitigationPct)));
    }

    public function getResidualImpactAttribute(): int {
        // Los correctivos mitigan impacto. Los detectivos ayudan un 50%.
        $corrScore = $this->controls->where('type', 'Correctivo')->sum('total_score');
        $detScore = $this->controls->where('type', 'Detectivo')->sum('total_score');
        
        $mitigationPct = min(100, $corrScore + ($detScore * 0.5)) / 100;
        return max(1, round($this->impact * (1 - $mitigationPct)));
    }

    public function getResidualScoreAttribute(): int {
        return $this->residual_probability * $this->residual_impact;
    }

    public function getResidualZoneAttribute(): string {
        $score = $this->residual_score;
        if ($score >= 13) return 'Extremo';
        if ($score >= 6)  return 'Alto';
        if ($score >= 2)  return 'Moderado';
        return 'Bajo';
    }
}