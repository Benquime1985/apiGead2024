<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemsAndServicesCollection;
use App\Http\Responses\ApiResponse;
use App\Models\ItemsAndServices;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ItemsAndServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $itemsandservices = new ItemsAndServicesCollection(ItemsAndServices::all());
            return ApiResponse::success('Listado De Servicos e Insumos',201,$itemsandservices);
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
                'departure' => 'required|min:3|max:50',
            ]);
            $itemsandservice = ItemsAndServices::create($request->all());
            return ApiResponse::success('Insumo u/o Servicio creado exitosamente',201,$itemsandservice);
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
            $itemsandservices = new ItemsAndServicesCollection(ItemsAndServices::query()->where('id',$id)->get());
            if ($itemsandservices->isEmpty()) throw new ModelNotFoundException("Insumo u/o Servicio No Encontrado");
            return ApiResponse::success( 'Insumo u/o Servicio encontrado',200,$itemsandservices);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Insumo u/o Servicio no encontrado',404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $itemsandservice = ItemsAndServices::findOrFail($id);
            $request -> validate([
                'name' => 'required|min:3|max:64',
                'departure' => 'required|min:3|max:50',
            ]);
            $itemsandservice->update($request->all());
            return  ApiResponse::success('Se ha actualizado el insumo u/o servicio',200,$itemsandservice);
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
            $itemsandservice= ItemsAndServices::findOrFail($id);
            $itemsandservice->delete();
            return ApiResponse::success("Isumo u/o servicio eliminado de manera correcta!!",200,$itemsandservice);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error("No se puede encontrar el insumo u/o servicio a eliminar");
        }
    }
}
