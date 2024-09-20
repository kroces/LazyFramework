<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends ModelSearchable{
    use HasFactory;

    public function json(){
        if(!isset($this->permiso_json))
            $this->permiso_json = json_decode($this->permisos);
        return $this->permiso_json;
    }

    public function permiso($url){
        $data = $this->json();
        if($data && sizeof($data) > 0)
            foreach($data as $element){
                if($url == $element->url){
                    return $element->switch;
                }
            }
        return false;
    }


}
