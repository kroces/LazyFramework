@foreach ($data as $item)
    <option value="{{$item['value']}}">{{$item['label']}}</option>
@endforeach