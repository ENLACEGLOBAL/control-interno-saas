<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tenant extends Model
{
    use HasFactory;

    protected $connection = 'mysql_backend';

    protected $fillable = [
        'name',
        'slug',
        'license_type',
        'is_active',
    ];

    /**
     * Relación: Una empresa (Tenant) tiene muchos Usuarios.
     */
    public function users(): BelongsToMany
    {
        $backendDb = config('database.connections.mysql_backend.database');
        
        return $this->belongsToMany(User::class, "{$backendDb}.tenant_user", 'tenant_id', 'user_id')
                    ->withTimestamps();
    }
}