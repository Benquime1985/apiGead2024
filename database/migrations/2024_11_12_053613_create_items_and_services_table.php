<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //* /**
    //  * Crea la tabla de ítems y servicios.
    //  *
    //  * Esta migración crea una nueva tabla para almacenar información de ítems y servicios,
    //  * incluyendo un ID único, nombre y numero de partida.
    //  */
    public function up(): void
    {
        Schema::create('items_and_services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('departure');
            $table->timestamps();
        });
    }

    //* /**
    //  * Revierte los cambios de la migración.
    //  *
    //  * Esta migración elimina la tabla de ítems y servicios.
    //  */
    public function down(): void
    {
        Schema::dropIfExists('items_and_services');
    }
};
