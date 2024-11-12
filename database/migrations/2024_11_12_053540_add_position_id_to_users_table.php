<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //* /**
    //  * Agrega la columna `position_id` a la tabla `users`.
    //  *
    //  * Esta migración agrega una nueva columna a la tabla `users` para establecer una relación
    //  * con la tabla `positions`. La relación es de tipo "uno a muchos", donde un usuario puede tener
    //  * una sola posición, pero una posición puede tener múltiples usuarios.
    //  *
    //  * Se utiliza una clave foránea para establecer la relación y se configuran las cascadas
    //  * para eliminar o actualizar automáticamente los registros relacionados.
    //  */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('position_id');
            $table->foreign('position_id')
                    ->references('id')
                    ->on('positions')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
    }

    //* /**
    //  * Revierte los cambios de la migración.
    //  *
    //  * Esta migración elimina la columna `position_id` de la tabla `users` y la relación
    //  * con la tabla `positions`.
    //  */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['position_id']);
            $table->dropColumn('position_id');
        });
    }
};
