<?php 
    /* 
        *field
        *required
        *label
        *options
        *select_value
        *select_name
        *value
        array
        
        @include('componentes.select',["label"=>"Sucursal", "field"=>"sucursal", "required"=>true, "options"=>$model->sucursales(), "select_value"=>"id", "select_name"=>"nombre", "value"=>$model])
    */
?>

<div class="form-group">
    <label for="{{$field}}_select" class="{{$errors->has($field)?"text-danger":""}}">{!! $required?"<b>*</b> ":"" !!}{{$label}}</label>
    <select class="form-control {{$errors->has($field)?"is-invalid":""}}" name="{{$field}}" id="{{$field}}_input" {{$required?"required":""}}>
        <option value="">Seleccione una opción</option>
        @if (isset($array))
            @foreach ($options as $element)
                <option value="{{$element[$select_value]}}" {{old($field)==$element[$select_value]?"selected":""}} {{(isset($value->$field) && !old($field))? ($value->$field == $element[$select_value]?"selected":"") : ""}}>{{$element[$select_name]}}</option>
            @endforeach
        @else
            @foreach ($options as $element)
                <option value="{{$element->$select_value}}" {{old($field)==$element->$select_value?"selected":""}} {{(isset($value->$field) && !old($field))? ($value->$field == $element->$select_value?"selected":"") : ""}}>{{$element->$select_name}}</option>
            @endforeach
        @endif
    </select>
    @if ($errors->has($field))
        <small id="{{$field}}_help" class="text-danger">
            @foreach ($errors->get($field) as $item)
                {{$item}}
            @endforeach
        </small>
    @endif
</div>