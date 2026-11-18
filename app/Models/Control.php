<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\AreaScope;

class Control extends Model
{
    protected $connection = 'mysql_backend';
    
    protected $fillable = [
        'tenant_id', 'area_id', 'risk_id', 'name', 'description', 
        'type', 'formal_score', 'application_score', 'effectiveness_score'
    ];

    // Aplicar el filtro de seguridad por áreas
    protected static function booted(): void {
        static::addGlobalScope(new AreaScope);
    }

    // Relaciones
    public function risk() {
        return $this->belongsTo(Risk::class);
    }

    public function area() {
        return $this->belongsTo(Area::class);
    }

    // --- ATRIBUTOS CALCULADOS ---

    /**
     * Suma total de los criterios del control (Max 100)
     */
    public function getTotalScoreAttribute(): int
    {
        return (int) $this->formal_score + (int) $this->application_score + (int) $this->effectiveness_score;
    }

    /**
     * Clasificación del control según la escala SCI
     */
    public function getClassificationAttribute(): string {
        $score = $this->total_score;

        if ($score >= 80) return 'Óptimo';
        if ($score >= 50) return 'Bueno';
        if ($score >= 25) return 'Débil';
        return 'Inaceptable';
    }

    /**
     * Color del Badge para la vista HTML
     */
    public function getBadgeClassAttribute(): string {
        return match($this->classification) {
            'Óptimo'      => 'badge-optimal',   // Verde oscuro
            'Bueno'       => 'badge-good',      // Azul
            'Débil'       => 'badge-weak',      // Naranja
            'Inaceptable' => 'badge-inacept',   // Rojo
            default       => 'bg-gray-100 text-gray-800',
        };
    }
}