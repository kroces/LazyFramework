<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ejemplo;
use App\Models\EjemploRelacion;
use Illuminate\Http\Request;

class LazyController extends Controller{

    public function index(Request $request){
        $Rdata = $this->getRouteData($request);

        $params = $Rdata["model"]->builder($request)->build();
        $params["breadcrumbs"] = [
            ["url"=>"/","name"=>"Inicio"],
            ["url"=>route("menu"),"name"=>"Menú"],
            ["url"=>route("administracion.menu"),"name"=>"Administración"],
            ["url"=>route("administracion." . $Rdata["type"] .  "." . $Rdata["action"]), "name"=> $Rdata["model"]->showName()],
        ];
        $params["type"] = $Rdata["type"];
        $params["model"] = $Rdata["model"];
        $params["encabezado"] = $Rdata["model"]->builderData();

        return view('administracion.catalogos.admin', $params);
    }

    public function create(Request $request){
        $Rdata = $this->getRouteData($request);

        $Rdata['inputs'] = $Rdata["model"]->formInputs();
        $Rdata["breadcrumbs"] = [
            ["url"=>"/","name"=>"Inicio"],
            ["url"=>route("menu"),"name"=>"Menú"],
            ["url"=>route("administracion.menu"),"name"=>"Administración"],
            ["url"=>route("administracion." . $Rdata["type"] .  ".admin"), "name"=> $Rdata["type"]],
            ["url"=>"", "name"=> "registrar"]
        ];

        return view('administracion.catalogos.create', $Rdata);
    }

    public function store(Request $request){
        $Rdata = $this->getRouteData($request);

        $Rdata["model"] = $Rdata["model"]->createNewModel($request);

        return redirect()->route("administracion.".$Rdata["type"].".consultar", $Rdata["model"]->id);
    }
    
    public function show(Request $request){
        $Rdata = $this->getRouteData($request);

        $Rdata['inputs'] = $Rdata["model"]->formInputs();
        $Rdata["breadcrumbs"] = [
            ["url"=>"/","name"=>"Inicio"],
            ["url"=>route("menu"),"name"=>"Menú"],
            ["url"=>route("administracion.menu"),"name"=>"Administración"],
            ["url"=>route("administracion." . $Rdata["type"] .  ".admin"), "name"=> $Rdata["model"]->showName()],
            ["url"=>"", "name"=> "consultar"]
        ];

        return view('administracion.catalogos.show', $Rdata);
    }
    
    public function edit(Request $request){
        $Rdata = $this->getRouteData($request);

        $Rdata['inputs'] = $Rdata["model"]->updateFormInputs();
        $Rdata["breadcrumbs"] = [
            ["url"=>"/","name"=>"Inicio"],
            ["url"=>route("menu"),"name"=>"Menú"],
            ["url"=>route("administracion.menu"),"name"=>"Administración"],
            ["url"=>route("administracion." . $Rdata["type"] .  ".admin"), "name"=> $Rdata["type"]],
            ["url"=>"", "name"=> "registrar"]
        ];

        return view('administracion.catalogos.update', $Rdata);
    }

    public function update(Request $request){
        $Rdata = $this->getRouteData($request);
        $input = $request->validate($Rdata["model"]->validateUpdateArray());
        $Rdata["model"]->update($input);
        return redirect()->route("administracion.".$Rdata["type"].".consultar", $Rdata["model"]->id);
    }

    public function destroy(Request $request){
        $Rdata = $this->getRouteData($request);

        $Rdata["model"]->delete();

        return redirect()->route("administracion.".$Rdata["type"].".admin");
    }
    private function getRouteData(Request $request){
        $modelId = $request->route('ejemplo'); // modelo por defecto
        if($modelId == null) $modelId = $request->route('ejemploRelacion'); // si es nulo cambiar por el siguiente modelo registrado
        // agregar más de ser necesario

        // Para el lazy CRUD
        $routeName = $request->route()->getName();

        // Se debe renombrar la ruta de la siguiente forma: GROUP.TYPE.ACTION
        // Route::any()->name(Administracion.Ejemplo.Index) //ejemplo
        $routeParts = explode('.', $routeName);

        // Assign the parts to an array with keys 'group', 'type', 'action'
        $routeData = [
            'group' => $routeParts[0] ?? null,
            'type' => $routeParts[1] ?? null,
            'action' => $routeParts[2] ?? null,
            "model"=> null
        ];

        // adquiere el modelo real Objeto, y si no existe lo crea
        switch($routeData["type"]){
            case "ejemplo":
                if($modelId) $routeData["model"] = Ejemplo::where("id", $modelId)->first(); 
                else $routeData["model"] = new Ejemplo();
            break;
            case "ejemploRelacion":
                if($modelId) $routeData["model"] = EjemploRelacion::where("id", $modelId)->first(); 
                else $routeData["model"] = new EjemploRelacion();
            break;
            // case "user": // agregar más de ser requerido
            //     if($modelId) $routeData["model"] = User::where("id", $modelId)->first(); 
            //     else $routeData["model"] = new User();
            // break;
        }

        return $routeData;
    }
}
