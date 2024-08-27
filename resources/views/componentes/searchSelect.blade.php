<?php
/*
    *title
    *name
    *value
    *event
    *options
    *change
    *click
*/
?>

<div class="input-group {{isset($noMargin)?"":"mt-4"}}">
    <div class="input-group-prepend">
        <span class="input-group-text">{{$title}}</span>
    </div>
    <input list="{{$name}}_select" type="text" class="form-control" name="{{$name}}" id="{{$name}}_id" value="{{old($name)?old($name):$value}}" onkeyup="{{$event}}" 
    onchange="child = $('#{{$name}}_select').children('[value=\''+$('#{{$name}}_id').val()+'\']'); $('#{{$name}}_value').html(child.html()); {{isset($change)?$change:''}}" onclick="{{isset($click)?$click:""}}">
    <div class="input-group-append">
        <span class="input-group-text" id="{{$name}}_value">
            @foreach ($options as $option)
                @if ($option["value"] == old($name) || $option["value"] == $value)
                    {{$option["label"]}}
                    @break
                @endif
            @endforeach
        </span>
    </div>
    <datalist id="{{$name}}_select">
        @foreach ($options as $option)
            <option value="{{$option['value']}}">{{$option["label"]}}</option>
        @endforeach
    </datalist>
</div>