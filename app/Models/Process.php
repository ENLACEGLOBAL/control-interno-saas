<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\AreaScope;

class Process extends Model
{
    protected $connection = 'mysql_backend';
    protected $fillable = ['tenant_id', 'area_id', 'name'];

    protected static function booted(): void {
        static::addGlobalScope(new AreaScope);
    }

    public function area() {
        return $this->belongsTo(Area::class);
    }
    
    public function risks() {
        return $this->hasMany(Risk::class);
    }
}