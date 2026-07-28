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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('imagen')->nullable();
            $table->string('fecha_icono')->nullable();
            $table->string('fecha_texto')->nullable();
            $table->string('icono')->nullable();
            $table->string('titulo');
            $table->text('texto')->nullable();
            $table->string('cta_url')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->boolean('activo')->default(true);
            $table->unsignedInteger('orden')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
