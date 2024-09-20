<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;
use App\Models\User;
use App\Tools\Router;

class PermisoController extends Controller
{
    
    public function edit(User $usuario){
        $data = Router::generarRoutasFormulario();
        return view("administracion.usuario.permiso.actualizar", ["data"=>$data, "model"=>$usuario]);
    }
    public function update(Request $request, User $usuario){
        $data = array_values($request->input()["data"]);
        foreach($data as $key=>$element){
            if(!isset($element["switch"])){ 
                $data[$key]["switch"] = false;
            }
        }
        $usuario->permisos = json_encode($data);
        $usuario->save();

        return redirect()->route("administracion.permiso.actualizar", ["usuario"=>$usuario->id]);
    }

    public function rol(Rol $rol){
        return view("administracion.usuario.permiso._form", ["data"=>Router::generarRoutasFormulario(), "model"=>$rol]);
    }
}
