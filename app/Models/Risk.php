<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\AreaScope;

class Risk extends Model
{
    protected $connection = 'mysql_backend';
    protected $fillable = [
        'tenant_id', 'area_id', 'process_id', 'code', 'category',
        'description', 'cause', 'consequence', 'probability', 'impact'
    ];

    protected static function booted(): void {
        static::addGlobalScope(new AreaScope);
    }

    public function process() {
        return $this->belongsTo(Process::class);
    }

    public function controls()
    {
        return $this->hasMany(Control::class);
    }

    // --- INHERENTE ---
    public function getInherentScoreAttribute(): int {
        return $this->probability * $this->impact;
    }

    public function getZoneAttribute(): string {
        $score = $this->inherent_score;
        if ($score >= 13) return 'Extremo';
        if ($score >= 6)  return 'Alto';
        if ($score >= 2)  return 'Moderado';
        return 'Bajo';
    }

    public function getZoneColorAttribute(): string {
        return match($this->zone) {
            'Extremo'  => '#C0392B',
            'Alto'     => '#E67E22',
            'Moderado' => '#F1C40F',
            default    => '#27AE60',
        };
    }
    
    // --- RESIDUAL (Cálculos de Mitigación) ---
    public function getResidualProbabilityAttribute(): int {
        $prevScore = $this->controls->where('type', 'Preventivo')->sum('total_score');
        $detScore  = $this->controls->where('type', 'Detectivo')->sum('total_score');
        
        $mitigationPct = min(100, $prevScore + ($detScore * 0.5)) / 100;
        return (int) max(1, round($this->probability * (1 - $mitigationPct)));
    }

    public function getResidualImpactAttribute(): int {
        $corrScore = $this->controls->where('type', 'Correctivo')->sum('total_score');
        $detScore  = $this->controls->where('type', 'Detectivo')->sum('total_score');
        
        $mitigationPct = min(100, $corrScore + ($detScore * 0.5)) / 100;
        return (int) max(1, round($this->impact * (1 - $mitigationPct)));
    }

    // --- LAS DOS FUNCIONES QUE FALTABAN ---
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