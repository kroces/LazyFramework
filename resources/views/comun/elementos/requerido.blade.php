@section('alert')
    <div class="alert alert-info" role="alert">
        <strong>@include('icons.alert') Info</strong> Los campos con * son obligatorios.
        {!!isset($extra)?"<br>".$extra:""!!}
    </div>
@endsection