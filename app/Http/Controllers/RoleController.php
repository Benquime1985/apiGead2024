<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleCollection;
use App\Http\Responses\ApiResponse;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $roles = new RoleCollection(Role::all());
            return ApiResponse::success('Listado de roles con usuarios',201, $roles);
        } catch (Exception $e){
            return ApiResponse::error('Error al obtener los roles',500);
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
    public function show(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}
