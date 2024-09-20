<?php

namespace App\Models;

use App\Tools\SearchBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Http\Request;

class EjemploRelacion extends ModelSearchable implements LazyModel
{
    use HasFactory;

    protected $table = 'ejemplorelacions';
    
    protected $fillable=[
        "nombre",
        "ejemplo_id",
    ];

    public function getValue($type){
        $value = $this->toArray();
        return $value[$type];
    }


    public function builder($request){
        $builder = new SearchBuilder(EjemploRelacion::select("*"), $request);
        $builder->search([
            ["name"=>"nombre", "op"=>'like' , "text"=>"%##%"],
            ["name"=>"ejemplo_id", "op"=>'like' , "text"=>"%##%"],
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
                'field'=>"ejemplo_id",
                'required'=>false,
                'type'=>"select",
                'label'=>'Ejemplo',
                'options'=>EjemploRelacion::all(),
                'select_value'=>'id',
                'select_name'=>'nombre'
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
           "ejemplo_id"=>"required",
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
                "label"=>"Ejemplo ID",
                "value"=>$this->ejemplo_id
            ],
        ];
    }
    public function showName(){
        return "Ejemplo Relación";
    }
    public function createNewModel(Request $request){
        $validation = $this->validateCreateArray();
        $input = $request->validate($validation);;
        return EjemploRelacion::create($input);
    }
    public function builderData(){
        return [ 
            ["campo"=>"nombre", "nombre"=>"Nombre"],
            ["campo"=>"ejemplo_id", "nombre"=>"Ejemplo ID"],
        ];
    }
}
