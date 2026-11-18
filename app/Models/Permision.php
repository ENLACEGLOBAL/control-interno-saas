<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permision extends SpatiePermission
{
    // Forzamos la conexión al backend
    protected $connection = 'mysql_backend';
}
