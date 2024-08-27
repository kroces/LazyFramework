<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelSearchable extends Model{
    
    use SoftDeletes;
    
    public function getValue($val){
        $data = $this->toArray();
        return $data[$val];
    }
}