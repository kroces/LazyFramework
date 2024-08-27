
{{-- 
    Paramters:
    $model (LazyModel)
    $class
--}}

<table class="{{$class}}">
    <tbody>
        @foreach ($model->simpleView() as $row)
            <tr>
                <th>{{$row["label"]}}</th>
                <td>{{$row["value"]}}</td>
            </tr>
        @endforeach
    </tbody>

</table>



