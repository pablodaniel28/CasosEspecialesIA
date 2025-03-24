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
        Schema::create('solicituds', function (Blueprint $table) {
            $table->id();
            $table->integer('codigo');
            $table->string('nombre');
            $table->string('gestion');
            $table->string('estado');
            $table->foreignId('estudiante_id')->constrained('estudiantes')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('director_id')->constrained('directors')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicituds');
    }
};
