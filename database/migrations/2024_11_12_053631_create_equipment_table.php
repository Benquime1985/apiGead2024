<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //* /**
    //  * Crea la tabla de equipos.
    //  *
    //  * Esta migración crea una nueva tabla para almacenar información de equipos,
    //  * incluyendo un ID único y el nombre del equipo.
    //  */
    public function up(): void
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }

    //* /**
    //  * Revierte los cambios de la migración.
    //  *
    //  * Esta migración elimina la tabla de equipos.
    //  */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
