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
        Schema::create('resultado_atleta_competencias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('atleta_id')->constrained()->onDelete('restrict');
            $table->foreignId('competencia_id')->constrained()->onDelete('restrict');

            $table->integer('puesto_atleta')->nullable();                                                                   
            $table->string('federacion_atleta')->nullable();
            $table->integer('edad_atleta')->nullable();
            $table->enum('equipamiento',['Raw','Wraps'])->nullable();
            $table->float('peso_corporal')->nullable();
            $table->enum('categoria_peso',['-47kg','-52kg','-57kg','-59kg','-63kg','-69kg','-76kg','-83kg','-93kg','-105kg','-115kg'])->nullable();
            $table->enum('categoria_edad',['teen <20','junior 20-23', 'senior 24-34', 'submaster 35-39','master 40-49','master 50-59','master 60+'])->nullable();
            $table->enum('tipo_competencia',['full-power','push-pull'])->nullable();
            
            $table->float('squat_1')->nullable();
            $table->float('squat_2')->nullable();
            $table->float('squat_3')->nullable();
            $table->float('bench_press_1')->nullable();
            $table->float('bench_press_2')->nullable();
            $table->float('bench_press_3')->nullable();
            $table->float('deadlift_1')->nullable();
            $table->float('deadlift_2')->nullable();
            $table->float('deadlift_3')->nullable();

            $table->boolean('squat_1_no_valido')->nullable();
            $table->boolean('squat_2_no_valido')->nullable();
            $table->boolean('squat_3_no_valido')->nullable();
            $table->boolean('bench_press_1_no_valido')->nullable();
            $table->boolean('bench_press_2_no_valido')->nullable();
            $table->boolean('bench_press_3_no_valido')->nullable();
            $table->boolean('deadlift_1_no_valido')->nullable();
            $table->boolean('deadlift_2_no_valido')->nullable();
            $table->boolean('deadlift_3_no_valido')->nullable();


            $table->float('total')->nullable();
            $table->float('puntos_ipf')->nullable();
            $table->float('puntos_dots')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultado_atleta_competencias');
    }
};
