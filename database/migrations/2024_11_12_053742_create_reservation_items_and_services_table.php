<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //* /**
    //  * Crea la tabla reservation_item_and_service`.
    //  *
    //  * Esta migración crea una nueva tabla para establecer una relación de muchos a muchos entre
    //  * las tablas `reservations` e `items_and_services`. Esto permite que una reserva tenga
    //  * múltiples ítems y servicios, y que un ítem o servicio pueda estar asociado con
    //  * múltiples reservas.
    //  */
    public function up(): void
    {
        Schema::create('reservation_items_and_services', function (Blueprint $table) {
            $table->unsignedBigInteger('reservation_id');  
            $table->foreign('reservation_id')
                    ->references('id')
                    ->on('reservations')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('item_and_service_id');  
            $table->foreign('item_and_service_id')
                    ->references('id')
                    ->on('items_and_services')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_items_and_services');
    }
};
