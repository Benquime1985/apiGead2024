<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleCollection;
use App\Http\Responses\ApiResponse;
use App\Models\Role;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
        try{
            $request -> validate([
                'name' => 'required|min:3|max:45',
            ]);
            $rol = Role::create($request->all());
            return ApiResponse::success("Se ha creado el rol correctamente", 200, $rol);
        } catch(ValidationException $e){
            return ApiResponse::error($e->getMessage(),404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{
            $role = new RoleCollection(Role::query()->where('id',$id)->get()); //select * from rols where id = $id;
            if ($role->isEmpty()) throw new ModelNotFoundException("Rol no encontrado");
            return ApiResponse::success( 'Información del rol',200,$role);
        }catch(ModelNotFoundException $e) {
            return ApiResponse::error( 'No existe el rol solicitado',404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $role = Role::findOrFail($id);
            $request -> validate([
                'name' => 'required|min:3|max:64',
            ]);
            $role->update($request->all());
            return  ApiResponse::success('Se ha actualizado el rol',200,$role);
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
            $rol=Role::findOrFail($id);
            $rol->delete();
            return ApiResponse::success("Rol eliminado de manera correcta!!",200,$rol);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error("No se puede encontrar al Rol a eliminar");
        }
    }
}
