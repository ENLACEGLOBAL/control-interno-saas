<?php
namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use App\Services\TenantContext;

class AreaScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        $context = app(TenantContext::class);

        // Si estamos en consola (migraciones/seeders) o no hay tenant activo, no filtramos
        if (app()->runningInConsole() || !$context->hasTenant()) {
            return;
        }

        // Si el usuario tiene acceso global (ver_todo), dejamos la consulta intacta
        if ($context->hasGlobalAccess()) {
            return;
        }

        // Filtro automático de áreas
        $builder->whereIn($model->getTable() . '.area_id', $context->getAllowedAreas());
    }
}