<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // La tabla pivote vive en el backend
        Schema::connection('mysql_backend')->create('area_user', function (Blueprint $table) {
            $table->id();
            
            // Llave foránea hacia el área (en la misma base de datos)
            $table->foreignId('area_id')->constrained('areas')->onDelete('cascade');
            
            // ID del usuario (Viene de mysql_auth, por lo que no usamos constrained)
            $table->unsignedBigInteger('user_id'); 
            
            $table->timestamps();

            // Evitamos que un usuario sea asignado dos veces a la misma área
            $table->unique(['area_id', 'user_id']);
        });
    }

    public function down(): void {
        Schema::connection('mysql_backend')->dropIfExists('area_user');
    }
};