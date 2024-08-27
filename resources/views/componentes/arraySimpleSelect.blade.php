<?php 
    /* 
        *field
        *required
        value
        *options (array)
            *value (key)
            *label (key)
        event
        class
        
        @include('componentes.arraySimpleSelect',["field"=>"producto", "required"=>true, "options"=>[
            ["value"=>"1", "label"=>"yes",]
            ["value"=>"2", "label"=>"no",]
        ]])
    */
?>

<div class="form-group">
    <select class="form-control {{$errors->has($field)?"is-invalid":""}} {{isset($class)?$class:""}}" name="{{$field}}" id="{{$field}}_input" {{$required?"required":""}} {!!isset($event)?$event:""!!}>
        <option value="">Seleccione una opción</option>
        @foreach ($options as $element)
            <option value="{{$element['value']}}" {{old($field) && old($field)==$element['value']?"selected":""}} {{(isset($value) && !old($field))? ($value == $element["value"]?"selected":"") : ""}}>{{$element["label"]}}</option>
        @endforeach
    </select>
</div>