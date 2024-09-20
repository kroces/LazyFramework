@include('comun.elementos.requerido')

@csrf

@include('componentes.errors')
<div class="row">
    @foreach ($data as $name => $cat)
        <div class="col-12">
            <h3 class="title-dark">{{$name}}</h3>
        </div>
        @foreach ($cat as $subcatname=>$subcat)
            <div class="col-12">
                <hr>
                <h4 class="pl-5 title-dark">{{$subcatname}}</h4>
            </div>
            @foreach ($subcat as $key=>$permiso)
                <div class="col-6">
                    <div class="row">
                        <div class="col-8 text-wrap">
                            {{$permiso["title"]}}
                        </div>
                        <div class="col-4">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" name="data[{{$key}}_{{$name}}_{{$subcatname}}][switch]" data-toggle="toggle" data-onstyle="outline-success" data-offstyle="outline-danger" data-size="md" data-on="Permitido" data-off="Negado" {{$model->permiso($permiso["url"])?"checked":""}} value="true">
                                </label>
                            </div>
                            <input type="hidden" name="data[{{$key}}_{{$name}}_{{$subcatname}}][url]" value="{{$permiso['url']}}">
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    @endforeach
</div>

<div class="d-lg-none">
    <input type="submit" value="Guardar" class="btn btn-success">
</div>

<div style="position: fixed; top: 270px; right: 50px;" class="d-none d-lg-inline-block">
    <input type="submit" value="Guardar" class="btn btn-success btn-lg">
</div>