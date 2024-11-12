<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //* /**
    //  * Crea la tabla de espacios.
    //  *
    //  * Esta migración crea una nueva tabla para almacenar información de espacios,
    //  * incluyendo un ID único, nombre, capacidad, descripción y timestamps.
    //  */
    public function up(): void
    {
        Schema::create('spaces', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100 );
            $table->string('capacity');
            $table->text('description');
            $table->timestamps();
        });
    }

    //* /**
    //  * Crea la tabla de espacios.
    //  *
    //  * Esta migración crea una nueva tabla para almacenar información de espacios,
    //  * incluyendo un ID único, nombre, capacidad, descripción y timestamps.
    //  */
    public function down(): void
    {
        Schema::dropIfExists('spaces');
    }
};
