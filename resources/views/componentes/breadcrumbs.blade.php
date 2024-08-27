<nav aria-label="breadcrumb" class="d-print-none">
    <ol class="breadcrumb">
        @for ($i = 0; $i < sizeof($breadcrumbs); $i++)
            <li class="breadcrumb-item {{$i<sizeof($breadcrumbs)-1?"":"active"}}" {{$i<sizeof($breadcrumbs)-1?"":"aria-current=\"page\""}}>
                @if ($i == sizeof($breadcrumbs)-1)
                    <span>{{$breadcrumbs[$i]['name']}}</span>
                @else
                    <a href="{{url($breadcrumbs[$i]['url'])}}">{{$breadcrumbs[$i]['name']}}</a>
                @endif
            </li>
        @endfor
    </ol>
</nav>