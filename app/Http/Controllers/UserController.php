<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\User;
use App\Tools\SearchBuilder;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller{

    public function index(Request $request){
        $builder = new SearchBuilder(User::select("*"), $request);

        $builder->search([
            ["name"=>"email", "op"=>'like' , "text"=>"%##%"],
        ]);

        $builder->orderBy();
        
        return view("administracion.usuario.admin", $builder->build());
    }

    public function create(){
        $usuario = new User();
        return view("administracion.usuario.registrar",["model"=>$usuario]);
    }

    public function store(Request $request){
        $data = $request->validate([
            "password"=>"required",
            "email"=>"required|unique:users",
        ]);
        $data["name"] = $data["email"];
        $data["password"] = Hash::make($data["password"]);
        $model = User::create($data);
        return redirect()->route("administracion.usuario.consultar",["user"=>$model->id]);
    }

    public function edit(User $user){
        $user->password = "";
        return view("administracion.usuario.actualizar",["model"=>$user]);
    }
    
    public function update(Request $request, User $user){
        $data = $request->validate([
            "password"=>"nullable",
            "email"=>"required|unique:users,email,".$user->id,
        ]);
        $data["name"] = $data["email"];
        if(isset($data["password"]) && $data["password"]){
            $data["password"] = Hash::make($data["password"]);
        }
        else{
            unset($data["password"]);
        }
        $user->update($data);
        return redirect()->route("administracion.usuario.consultar",["user"=>$user->id]);
    }

    public function show(User $user){
        return view("administracion.usuario.consultar",["model"=>$user]);
    }

    public function delete(User $user){
        if($user->rol_id === 0 && auth()->user()->rol_id !== 0){
            return redirect("authError");
        }
        if($user->canDelete()){
            $user->delete();
        }
        else{
            /*request()->session()->flash('data_msg', 'Registro en uso, no se puede eliminar');
            request()->session()->flash('data_type', 'danger');
            request()->session()->flash('data_title', 'Error');*/
        }
        return redirect()->route("administracion.usuario.admin");
    }
}
