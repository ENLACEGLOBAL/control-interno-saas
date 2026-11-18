<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    // La conexión de autenticación ya es la que toma por defecto, 
    // pero si quieres ser explícito, puedes dejarlo:
    protected $connection = 'mysql_auth';

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_superadmin', // <-- Agregado
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_superadmin' => 'boolean', // <-- Agregado
        ];
    }

    /**
     * Relación: Un usuario puede pertenecer a muchas Empresas (Tenants).
     * Como la tabla pivote y los tenants están en el backend, 
     * le pasamos el nombre completo de la base de datos en la tabla pivote.
     */
    public function tenants(): BelongsToMany
    {
        $backendDb = config('database.connections.mysql_backend.database');
        
        return $this->belongsToMany(Tenant::class, "{$backendDb}.tenant_user", 'user_id', 'tenant_id')
                    ->withTimestamps();
    }
}
