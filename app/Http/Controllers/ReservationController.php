<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReservationCollection;
use App\Http\Resources\ReservationResource;
use App\Http\Responses\ApiResponse;
use App\Models\Reservation;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $reservations = new ReservationCollection(Reservation::all());
            return ApiResponse::success('Listado De las Reservaciones',201,$reservations);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(),500);
        }
    }

    public function details($id)
    {
        try {
            $reservation = Reservation::with('itemsandservices', 'equipments')->findOrFail($id);
            return ApiResponse::success('Detalles de la Reserva', 200, $reservation);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validación de los datos recibidos
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'space_id' => 'required|exists:spaces,id',
                'reservation_date' => 'required|date',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
                'status' => 'required|string|max:20',
                'event_type' => 'required|min:1|max:10',
                'uploaded_job' => ['nullable', 'file', 'mimes:pdf,doc,docx,txt', 'max:20480'],
                'reservation_details' => 'nullable|string',
                'items_and_services' => 'nullable|array', 
                'items_and_services.*.item_and_service_id' => 'exists:items_and_services,id',
                'equipment' => 'nullable|array',
                'equipment.*.equipment_id' => 'exists:equipment,id', 
            ]);
    
            // Crear una nueva reservación
            $reservation = Reservation::create($request->except(['items_and_services', 'equipment'])); 
    
            // Adjuntar items_and_services
            foreach ($request->input('items_and_services', []) as $item) { 
                $reservation->itemsAndServices()->attach($item['item_and_service_id']);
            }
            
            // Adjuntar equipment
            $reservation->equipments()->attach($request->input('equipment', [])); 
    
            // Manejo de archivo (si se sube) - Este bloque se mantiene igual
            if ($request->hasFile('uploaded_job')) { 
                $file = $request->file('uploaded_job');
                $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $name_file = str_replace(" ", "_", $filename); 
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = date('His') . '_' . $name_file . '.' . $extension;
                $file->move(public_path('/uploads/Doc_reservations'), $fileNameToStore); 
                $reservation->uploaded_job = '/uploads/Doc_reservations/' . $fileNameToStore; // Corregir la ruta
            }
            $reservation->save();
            return ApiResponse::success("Reservación creada correctamente.", 200, new ReservationResource($reservation));
        } catch (ValidationException $e) {
            return ApiResponse::error($e->getMessage(), 422);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500); 
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{
            $reservation = new ReservationCollection(Reservation::query()->where('id',$id)->get());
            if($reservation->isEmpty()) throw new ModelNotFoundException("Reservacion No Encontrado");
            return ApiResponse::success( 'Reservacion Encontrada',200,$reservation);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Reservacion No Encontrada',404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $reservation = Reservation::findOrFail($id);
            // Validación de los datos recibidos
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'space_id' => 'required|exists:spaces,id',
                'reservation_date' => 'required|date',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
                'status' => 'required|string|max:20',
                'uploaded_job' => ['nullable', 'file', 'mimes:pdf,doc,docx,txt', 'max:20480'],
                'reservation_details' => 'nullable|string',
                // Agrega aquí la validación para items_and_services y equipment
                'items_and_services' => 'array', 
                'items_and_services.*.item_and_service_id' => 'exists:items_and_services,id',
                'items_and_services.*.quantity' => 'integer|min:1',
                'equipment' => 'array',
                'equipment.*.equipment_id' => 'exists:equipment,id', 
            ]);
    
            // Crear una nueva reservación
            $reservation = Reservation::create($request->except(['items_and_services', 'equipment'])); 
    
            // Adjuntar items_and_services
            foreach ($request->input('items_and_services') as $item) {
                $reservation->itemsAndServices()->attach($item['item_and_service_id'], ['quantity' => $item['quantity']]);
            }
    
            // Adjuntar equipment
            $reservation->equipments()->attach($request->input('equipment'));
    
            // Manejo de archivo (si se sube) - Este bloque se mantiene igual
            if ($request->hasFile('uploaded_job')) { 
                $file = $request->file('uploaded_job');
                $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $name_file = str_replace(" ", "_", $filename); 
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = date('His') . '_' . $name_file . '.' . $extension;
                $file->move(public_path('/uploads/Doc_reservations'), $fileNameToStore); 
                $reservation->uploaded_job = '/uploads/Doc_reservations/' . $fileNameToStore; // Corregir la ruta
            }
            $reservation->save();
            return ApiResponse::success("Reservación creada correctamente.", 200, new ReservationResource($reservation));
        } catch (ValidationException $e) {
            return ApiResponse::error($e->getMessage(), 422);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500); 
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
