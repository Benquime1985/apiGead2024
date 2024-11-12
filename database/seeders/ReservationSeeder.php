<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //! Paso 1: Crear Tablas Temporales
        DB::statement("CREATE TEMPORARY TABLE temp_items_and_services (reservation_id INT, items_and_service_id INT)");
        DB::statement("CREATE TEMPORARY TABLE temp_equipment (reservation_id INT, equipment_id INT)");

        //! Paso 2: Crear datos base para las reservaciones
        $reservationData = [
            [
                'user_id' => 1,
                'space_id' => 1,
                'reservation_date' => Carbon::now()->subDays(3),
                'start_date' => Carbon::now()->toDateString(),
                'end_date' => Carbon::now()->toDateString(),
                'start_time' => Carbon::now()->setTime(10, 0)->format('H:i:s'), // 10:00 AM
                'end_time' => Carbon::now()->setTime(12, 0)->format('H:i:s'),  // 12:00 PM
                'status' => 'aprobado',
                'event_type' => 'Conferencia',
                'reservation_details' => 'Reservation with specific equipment',
                'uploaded_job' => 'Upload_job123',
                'requisition_number' => 'REQ-001',
            ],
            [
                'user_id' => 2,
                'space_id' => 2,
                'reservation_date' => Carbon::now()->subDays(2),
                'start_date' => Carbon::now()->toDateString(),
                'end_date' => Carbon::now()->toDateString(),
                'start_time' => Carbon::now()->setTime(14, 0)->format('H:i:s'), // 2:00 PM
                'end_time' => Carbon::now()->setTime(16, 0)->format('H:i:s'),  // 4:00 PM
                'status' => 'pendiente',
                'event_type' => 2,
                'reservation_details' => 'Reservation with different equipment and offerings',
                'uploaded_job' => 'Upload_job456',
                'requisition_number' => 'REQ-002',
            ],
        ];

        //! Paso 3: Insertar las reservaciones y poblar tablas temporales
        foreach ($reservationData as $data) {
            $reservationId = DB::table('reservations')->insertGetId($data);

            DB::table('temp_items_and_services')->insert([
                ['reservation_id' => $reservationId, 'items_and_service_id' => 1],
                ['reservation_id' => $reservationId, 'items_and_service_id' => 2],
            ]);

            DB::table('temp_equipment')->insert([
                ['reservation_id' => $reservationId, 'equipment_id' => 1],
                ['reservation_id' => $reservationId, 'equipment_id' => 2],
            ]);
        }

        //! Paso 4: Insertar en las tablas finales usando las tablas temporales
        DB::table('temp_items_and_services')->get()->each(function ($temp) {
            DB::table('reservation_items_and_services')->insert([
                'reservation_id' => $temp->reservation_id,
                'item_and_service_id' => $temp->items_and_service_id,
            ]);
        });

        DB::table('temp_equipment')->get()->each(function ($temp) {
            DB::table('reservation_equipment')->insert([
                'reservation_id' => $temp->reservation_id,
                'equipment_id' => $temp->equipment_id,
            ]);
        });

        //! Paso 5: Borrar tablas temporales
        DB::statement("DROP TEMPORARY TABLE IF EXISTS temp_items_and_services");
        DB::statement("DROP TEMPORARY TABLE IF EXISTS temp_equipments");
    }
}
