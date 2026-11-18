<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $connection = 'mysql_backend';
    protected $fillable = ['tenant_id', 'name'];

    public function processes() {
        return $this->hasMany(Process::class);
    }
}