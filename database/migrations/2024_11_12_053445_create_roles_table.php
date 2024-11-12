<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //* /**
    //  * Crea la tabla de roles.
    //  *
    //  * Esta migración crea una nueva tabla para almacenar información de roles,
    //  * incluyendo un ID único y el nombre del rol.
    //  */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }

    //* /**
    //  * Revierte los cambios de la migración.
    //  *
    //  * Esta migración elimina la tabla de roles.
    //  */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};