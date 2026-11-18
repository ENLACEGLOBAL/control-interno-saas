<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    // Forzamos la conexión al backend
    protected $connection = 'mysql_backend';
}
