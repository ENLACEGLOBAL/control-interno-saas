<?php

namespace App\Services;

use App\Models\Tenant;

class TenantContext
{
    private ?Tenant $tenant = null;
    
    // Nuevas propiedades para el filtrado por áreas
    private array $allowedAreas = [];
    private bool $hasGlobalAccess = false;

    // --- MÉTODOS DEL TENANT ---

    public function setTenant(Tenant $tenant): void
    {
        $this->tenant = $tenant;
    }

    public function getTenant(): ?Tenant
    {
        return $this->tenant;
    }

    public function getTenantId(): ?int
    {
        return $this->tenant ? $this->tenant->id : null;
    }

    public function hasTenant(): bool
    {
        return $this->tenant !== null;
    }

    // --- MÉTODOS DE ÁREAS Y ACCESO GLOBAL ---

    public function setAllowedAreas(array $areaIds): void
    {
        $this->allowedAreas = $areaIds;
    }

    public function getAllowedAreas(): array
    {
        return $this->allowedAreas;
    }

    public function setGlobalAccess(bool $access): void
    {
        $this->hasGlobalAccess = $access;
    }

    public function hasGlobalAccess(): bool
    {
        return $this->hasGlobalAccess;
    }
}