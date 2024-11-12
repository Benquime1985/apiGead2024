<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //* /**
    //  * Crea la tabla de reservas.
    //  *
    //  * Esta migración crea una nueva tabla para almacenar información de reservas,
    //  * incluyendo un ID único, relaciones con las tablas de usuarios y espacios,
    //  * fechas de reserva, horarios, tipo de evento, estado, detalles de la reserva,
    //  * número de requisición y timestamps.
    //  */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('space_id');
            $table->foreign('space_id')
                    ->references('id')
                    ->on('spaces')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->date('reservation_date');
            $table->date('start_date'); 
            $table->date('end_date');    
            $table->time('start_time');
            $table->time('end_time');  
            $table->enum('event_type', ['Congreso', 'Encuentro', 'Seminario','Mesa redonda','Simposio','Panel','Foro','Conferencia','Jornada','Cursos','Coloquio', 'Semana','Taller'])->nullable();  //? Estado de la reserva (e.g., pendiente, confirmada, cancelada)
            $table->enum('status', ['pendiente', 'aprobado', 'rechazado'])->default('pendiente');
            $table->text('uploaded_job');
            $table->text('reservation_details');
            $table->text('requisition_number')->nullable();
            $table->timestamps();
        });
    }

    //* /**
    //  * Revierte los cambios de la migración.
    //  *
    //  * Esta migración elimina la tabla de reservas.
    //  */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
