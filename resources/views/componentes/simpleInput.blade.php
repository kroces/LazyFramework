
<div class="form-group">
    <input {{$required?"required":""}} id="{{$field}}_input" class="form-control {{$errors->has($field)?"is-invalid":""}} {{isset($class)?$class:""}}" type="{{$type}}" name="{{$field}}" value="{{old($field)?old($field):(isset($value)?$value:"")}}" max="{{isset($max)?$max:""}}" {!!isset($event)?$event:""!!}>
</div>