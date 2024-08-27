{{--
    @include("componentes.tabla",[
        "clases" => string //clases de la tabla
        encabezado => [ 
            // nombre = texto visible (string), 
            // campo = campo en la base de datos (string),
            [
                "campo"=>"string"
                "nombre"=>"string", 
                "order"
            ]
        ],
        data => collection, // $model->paginate();
        o => string // order
        om => string // order mode (asc, desc)
        q => string // search query 
        op=> [
            [
                "url"=>"string",
                "class"=>"string",
                "text"=>"string",
                "icon"=>"string",
            ]
        ] // operaciones

    ]) 
--}}
<div class="table-responsive">
    <table class="{{$clases}}">
        <thead>
            <tr>
                @foreach ($encabezado as $item)
                    <th>
                        @if (isset($item["order"]))
                            {{$item["nombre"]}}
                        @else
                            @if ($o == $item["campo"])
                                @if ($om == "asc")
                                    <a href="{{route(request()->route()->getName())}}?{{$getParameters}}&o={{$item["campo"]}}&om=desc">
                                        {{$item["nombre"]}} ↓
                                    </a>
                                @else
                                    <a href="{{route(request()->route()->getName())}}?{{$getParameters}}&o={{$item["campo"]}}&om=asc">
                                        {{$item["nombre"]}} ↑
                                    </a>
                                @endif
                            @else
                                <a href="{{route(request()->route()->getName())}}?{{$getParameters}}&o={{$item["campo"]}}">
                                    {{$item["nombre"]}}
                                </a>
                            @endif
                        @endif
                    </th>
                @endforeach
                <th>
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    @foreach ($encabezado as $en)
                        <td>{{$item->getValue($en["campo"]) }}</td>
                    @endforeach
                    <td>
                        @foreach ($op as $option)
                            @if (!isset($option["visible"]) || (isset($option["visible"]) && gettype($option["visible"]) == "boolean" && $option["visible"]) || (isset($option["visible"]) && gettype($option["visible"]) == "object" && $option["visible"]($item)) )
                                @if (isset($option["div"]))
                                    <div href="{{ str_replace("_model.id", $item->id, $option["url"]) }}" class="{{$option["class"]}}" @if (isset($option["target"]))target="{{$option["target"]}}" @endif @if (isset($option["onclick"]))onclick="{{$option["onclick"]}}" @endif>
                                        @if (isset($option["icon"]))
                                            @include($option["icon"])
                                        @endif
                                        {{ $option["text"] }}
                                    </div>    
                                @else
                                    <a href="{{ str_replace("_model.id", $item->id, $option["url"]) }}" class="{{$option["class"]}}" @if (isset($option["target"]))target="{{$option["target"]}}" @endif @if (isset($option["onclick"]))onclick="{{$option["onclick"]}}" @endif>
                                        @if (isset($option["icon"]))
                                            @include($option["icon"])
                                        @endif
                                        {{ $option["text"] }}
                                    </a>    
                                @endif
                            @endif
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{$models->links('pagination::bootstrap-4')}}