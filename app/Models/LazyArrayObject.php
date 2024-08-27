<?php

namespace App\Models;

class LazyArrayObject{
    public $label;
    public $value;

    public function __construct($label, $value){
        $this->label = $label;
        $this->value = $value;
    }


    public static function getArray(array $array){
        $data = [];
        foreach($array as $value=>$label){
            $data[] = new LazyArrayObject($label, $value);
        }
        return $data;
    }
}
