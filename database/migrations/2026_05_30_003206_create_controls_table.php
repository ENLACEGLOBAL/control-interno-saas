<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::connection('mysql_backend')->create('controls', function (Blueprint $table) {
            $table->id();
            
            // Relaciones
            $table->foreignId('tenant_id')->constrained('tenants')->onDelete('cascade');
            $table->foreignId('area_id')->constrained('areas')->onDelete('cascade');
            $table->foreignId('risk_id')->constrained('risks')->onDelete('cascade');
            
            // Datos del Control
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('type', ['Preventivo', 'Detectivo', 'Correctivo']);
            
            // Criterios de Evaluación (Máximo 100 puntos en total)
            $table->unsignedTinyInteger('formal_score')->default(0);      // Max 15
            $table->unsignedTinyInteger('application_score')->default(0); // Max 20
            $table->unsignedTinyInteger('effectiveness_score')->default(0); // Max 65
            
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::connection('mysql_backend')->dropIfExists('controls');
    }
};