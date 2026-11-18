<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::connection('mysql_backend')->create('risks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->onDelete('cascade');
            $table->foreignId('area_id')->constrained('areas')->onDelete('cascade');
            $table->foreignId('process_id')->constrained('processes')->onDelete('cascade');
            
            $table->string('code', 20); // RSCI-35
            $table->string('category')->default('Operacional');
            $table->text('description');
            $table->text('cause')->nullable();
            $table->text('consequence')->nullable();
            
            $table->unsignedTinyInteger('probability'); 
            $table->unsignedTinyInteger('impact');
            
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::connection('mysql_backend')->dropIfExists('risks');
    }
};