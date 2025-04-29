<h1>{{$modo}} libro</h1>

@if(count($errors)>0)
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="form-group">
    <label for="titulo">Titulo</label>
    <input class="form-control" type="text" name="titulo" value="{{isset($libro->titulo)?$libro->titulo:old('titulo') }}" id="titulo">
</div>

<div class="form-group">
    <label for="autor">Autor</label>
    <input class="form-control" type="text" name="autor" value="{{isset($libro->autor)?$libro->autor:old('autor') }}" id="autor">
</div>

<div class="form-group">
    <label for="genero">Genero</label>
    <input class="form-control" type="text" name="genero" value="{{isset($libro->genero)?$libro->genero:old('genero') }}" id="genero">
</div>

<div class="form-group">
    <label for="estado">Estado</label>
    <select class="form-control" name="estado" id="estado">
        @if (isset($libro->estado))
        <option value="{{$libro->estado}}" selected>{{$libro->estado}}</option>
        <option value="">---Seleccione---</option>
        <option value="Disponible">Disponible</option>
        <option value="No disponible">No disponible</option>
        <option value="Asignado">Asignado</option>
        @endif

        @if (empty($libro->estado))
        <option value="{{isset($libro->genero)?$libro->estado:old('estado') }}">{{isset($libro->genero)?$libro->estado:old('estado')}}</option>
        <option value="">---Seleccione---</option>
        <option value="Disponible">Disponible</option>
        <option value="No disponible">No disponible</option>
        <option value="Asignado">Asignado</option>
        @endif

    </select>
</div>
<br>
<input class="btn btn-success" type="submit" value="{{$modo}} libro">

<a class="btn btn-primary" href="{{url('libro/')}}">Volver</a>

<br>

