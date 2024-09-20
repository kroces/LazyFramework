<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Tools\Router;
use Illuminate\Support\Facades\Route;
use App\Tools\SearchBuilder;
use Illuminate\Http\Request;

class RolController extends Controller{
    
    public function index(Request $request){
        $builder = new SearchBuilder(Rol::select("*"), $request);

        $builder->search([
            ["name"=>"nombre", "op"=>'like' , "text"=>"%##%"],
        ]);

        $builder->orderBy();
        
        return view("administracion.rol.admin", $builder->build());
    }

    public function create(){
        $data = Router::generarRoutasFormulario(false);
        return view("administracion.rol.registrar", ["model"=>new Rol(), "data"=>$data]);
    }
    
    public function store(Request $request){
        $rol = new Rol();
        $data = array_values($request->input()["data"]);
        foreach($data as $key=>$element){
            if(!isset($element["switch"])){ 
                $data[$key]["switch"] = false;
            }
        }
        $rol->nombre = $request->input()["nombre"];
        $rol->permisos = json_encode($data);
        $rol->save();

        return redirect()->route("administracion.rol.consultar", ["rol"=>$rol->id]);
    }
    
    public function show(Rol $rol){
        return view("administracion.rol.consultar", ["model"=>$rol]);
    }
    
    public function edit(Rol $rol){
        $data = Router::generarRoutasFormulario();
        return view("administracion.rol.actualizar", ["data"=>$data, "model"=>$rol]);
    }
    public function update(Request $request, Rol $rol){
        $data = array_values($request->input()["data"]);

        foreach($data as $key=>$element){
            if(!isset($element["switch"])){ 
                $data[$key]["switch"] = false;
            }
        }
        $rol->nombre = $request->input()["nombre"];
        $rol->permisos = json_encode($data);
        $rol->save();

        return redirect()->route("administracion.rol.consultar", ["rol"=>$rol->id]);
    }
    
    public function destroy(Rol $rol){
        $rol->delete();
        return redirect()->route("administracion.rol.admin");
    }
}
