<?php 
    /* 
        *field
        *required
        *label
        *type
        *value
        max
        disabled
        readonly
        step

        @ include('componentes.input', ["field"=>"descripcion","required"=>true,"label"=>"Descripción","type"=>"text","value"=>$model,])
    */
?>
<div class="form-group">
    <label for="{{$field}}_input" class="{{$errors->has($field)?"text-danger":""}}">{!! $required?"<b>*</b> ":"" !!}{{$label}}</label>
    <input 
        {{$required?"required":""}} 
        id="{{$field}}_input" 
        class="form-control {{$errors->has($field)?"is-invalid":""}}" 
        type="{{$type}}" 
        name="{{$field}}" 
        
        @if (isset($value) && getType($value) == "string")
            value="{{old($field, $value)}}"
        @else
            value="{{old($field, isset($value)?$value->$field:"")}}"
        @endif

        {{isset($max)?"max=".$max:""}} 
        {!!isset($placeholder)?"placeholder=\"".$placeholder."\"":""!!} 
        {{isset($disabled)?"disabled":""}}
        {{isset($readonly)?"readonly":""}}
        {{isset($step)?("step=".$step):""}}
    >
    @if ($errors->has($field))
        <small id="{{$field}}_help" class="text-danger">
            @foreach ($errors->get($field) as $item)
                {{$item}}
            @endforeach
        </small>
    @endif
</div>