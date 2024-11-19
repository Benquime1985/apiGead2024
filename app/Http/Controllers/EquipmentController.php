<?php

namespace App\Http\Controllers;

use App\Http\Resources\EquipmentCollection;
use App\Http\Responses\ApiResponse;
use App\Models\Equipment;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $equipments = new EquipmentCollection(Equipment::all());
            return ApiResponse::success('Listado De Equipos',201,$equipments);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(),500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request -> validate([
                'name' => 'required|min:3|max:50',
            ]);
            $equipment = Equipment::create($request->all());
            return ApiResponse::success('Equipo creado exitosamente',201,$equipment);
        }catch(ValidationException $e){
            return ApiResponse::error($e->getMessage(),404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $equipments = new EquipmentCollection(Equipment::query()->where('id',$id)->get());
            if ($equipments->isEmpty()) throw new ModelNotFoundException("Equipo No Encontrado");
            return ApiResponse::success( 'Equipo encontrado',200,$equipments);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Equipo no encontrado',404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $equipment = Equipment::findOrFail($id);
            $request -> validate([
                'name' => 'required|min:3|max:64',
            ]);
            $equipment->update($request->all());
            return  ApiResponse::success('Se ha actualizado el equipo',200,$equipment);
        } catch (ModelNotFoundException $e){
            return ApiResponse::error($e->getMessage(),404);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(),500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $equipment = Equipment::findOrFail($id);
            $equipment->delete();
            return ApiResponse::success("Equipo eliminado de manera correcta!!",200,$equipment);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error("No se puede encontrar el Equipo a eliminar");
        }
    }
}
