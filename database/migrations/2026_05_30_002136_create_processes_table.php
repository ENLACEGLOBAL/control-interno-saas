<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::connection('mysql_backend')->create('processes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->onDelete('cascade');
            $table->foreignId('area_id')->constrained('areas')->onDelete('cascade');
            $table->string('name'); // Ej: Cuentas por pagar
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::connection('mysql_backend')->dropIfExists('processes');
    }
};