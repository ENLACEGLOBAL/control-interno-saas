<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('mysql_backend')->create('tenant_user', function (Blueprint $table) {
            $table->id();
            // Como 'users' está en otra BD (saas_auth), guardamos el ID como entero simple 
            // y no ponemos foreignKey estricta a nivel de base de datos si están en servidores distintos.
            $table->unsignedBigInteger('user_id'); 
            
            // Relación con el Tenant (en la misma BD backend)
            $table->foreignId('tenant_id')->constrained('tenants')->onDelete('cascade');
            
            $table->timestamps();

            // Evitamos duplicados: un usuario no puede estar asignado dos veces a la misma empresa
            $table->unique(['user_id', 'tenant_id']); 
        });
    }

    public function down(): void
    {
        Schema::connection('control_interno_backend')->dropIfExists('tenant_user');
    }
};