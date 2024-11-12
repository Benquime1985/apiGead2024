<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //* /**
    //  * Agrega la columna `role_id` a la tabla `users`.
    //  *
    //  * Esta migración agrega una nueva columna a la tabla `users` para establecer una relación
    //  * con la tabla `roles`. La relación es de tipo "uno a muchos", donde un usuario puede tener
    //  * un solo rol, pero un rol puede tener múltiples usuarios.
    //  *
    //  * Se utiliza una clave foránea para establecer la relación y se configuran las cascadas
    //  * para eliminar o actualizar automáticamente los registros relacionados.
    //  */

    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')
                    ->references('id')
                    ->on('roles')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
    }

    //* /**
    //  * Revierte los cambios de la migración.
    //  *
    //  * Esta migración elimina la columna `role_id` de la tabla `users` y la relación
    //  * con la tabla `roles`.
    //  */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
};
