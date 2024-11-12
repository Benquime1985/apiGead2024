<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReservationCollection;
use App\Http\Responses\ApiResponse;
use App\Models\Reservation;
use Exception;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
