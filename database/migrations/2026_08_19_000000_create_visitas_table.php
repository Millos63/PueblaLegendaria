<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('visitante', 64); // huella hasheada (no es la IP real)
            $table->timestamp('created_at')->nullable();

            // Un mismo visitante solo cuenta una vez por día.
            $table->unique(['fecha', 'visitante']);
            $table->index('fecha');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitas');
    }
};
