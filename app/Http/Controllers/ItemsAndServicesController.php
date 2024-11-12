<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemsAndServicesCollection;
use App\Http\Responses\ApiResponse;
use App\Models\ItemsAndServices;
use Exception;
use Illuminate\Http\Request;

class ItemsAndServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $offerings = new ItemsAndServicesCollection(ItemsAndServices::all());
            return ApiResponse::success('Listado De Servicos e Insumos',201,$offerings);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(),500);
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
    public function show(ItemsAndServices $itemsAndServices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ItemsAndServices $itemsAndServices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemsAndServices $itemsAndServices)
    {
        //
    }
}
