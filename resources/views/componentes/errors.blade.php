@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Hay un error.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif