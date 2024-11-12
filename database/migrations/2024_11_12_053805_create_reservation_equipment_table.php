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
        Schema::create('reservation_equipment', function (Blueprint $table) {
            $table->unsignedBigInteger('reservation_id');  
            $table->foreign('reservation_id')
                    ->references('id')
                    ->on('reservations')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('equipment_id');  
            $table->foreign('equipment_id')
                    ->references('id')
                    ->on('equipments')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_equipment');
    }
};
