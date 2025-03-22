<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('atletas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable()->unique();    
            $table->string('pais')->nullable();
            $table->enum('sexo',['masculino','femenino'])->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->float('altura')->nullable();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atleta');
    }
};
