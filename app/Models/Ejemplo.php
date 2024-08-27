<?php

namespace App\Models;

use App\Tools\SearchBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Http\Request;

class Ejemplo extends ModelSearchable implements LazyModel
{
    use HasFactory;
    protected $fillable=[
        "nombre",
        "apellido_paterno",
        "apellido_materno",
        "alias",
    ];

    public function getValue($type){
        $value = $this->toArray();
        return $value[$type];
    }


    public function builder($request){
        $builder = new SearchBuilder(Ejemplo::select("*"), $request);
        $builder->search([
            ["name"=>"nombre", "op"=>'like' , "text"=>"%##%"],
            ["name"=>"apellido_paterno", "op"=>'like' , "text"=>"%##%"],
            ["name"=>"apellido_materno", "op"=>'like' , "text"=>"%##%"],
            ["name"=>"alias", "op"=>'like' , "text"=>"%##%"],
        ]);
        $builder->orderBy();
        return $builder;
    }

    public function formInputs(){
        return [
            [  
                'field'=>"nombre",
                'required'=>"true",
                'type'=>"text",
                'label'=>'Nombre'
            ],
            [  
                'field'=>"apellido_paterno",
                'required'=>"true",
                'type'=>"text",
                'label'=>'Apellido paterno'
            ],
            [  
                'field'=>"apellido_materno",
                'required'=>"true",
                'type'=>"text",
                'label'=>'Apellido materno'
            ],
            [  
                'field'=>"alias",
                'required'=>"true",
                'type'=>"text",
                'label'=>'Alias'
            ],
        ];
    }
    public function updateFormInputs(){
        $update = $this->formInputs();
        foreach($update as $key => $input){
            $update[$key]["value"] = $this;
        }
        return $update;
    }
    public function validateCreateArray(){
        return [
           "nombre"=>"required",
           "apellido_paterno"=>"required",
           "apellido_materno"=>"required",
           "alias"=>"required",
        ];
    }
    public function validateUpdateArray(){
        return $this->validateCreateArray();
    }
    public function simpleView(){
        return [
            [
                "label"=>"Nombre",
                "value"=>$this->nombre
            ],
            [
                "label"=>"Apellido paterno",
                "value"=>$this->apellido_paterno
            ],
            [
                "label"=>"Apellido materno",
                "value"=>$this->apellido_materno
            ],
            [
                "label"=>"Alias",
                "value"=>$this->alias
            ],
        ];
    }
    public function showName(){
        return "Ayudante";
    }
    public function createNewModel(Request $request){
        $validation = $this->validateCreateArray();
        $input = $request->validate($validation);;
        return Ejemplo::create($input);
    }
    public function builderData(){
        return [ 
            ["campo"=>"nombre", "nombre"=>"Nombre"],
            ["campo"=>"apellido_paterno", "nombre"=>"Apellido paterno"],
            ["campo"=>"apellido_materno", "nombre"=>"Apellido materno"],
            ["campo"=>"alias", "nombre"=>"Alias"],
        ];
    }
}
