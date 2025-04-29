<h1>{{$modo}} cliente</h1>

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
    <label for="cedula">Cedula</label>
    <input class="form-control" type="text" name="cedula" value="{{isset($cliente->cedula)?$cliente->cedula:old('cedula') }}" id="cedula">
</div>

<div class="form-group">
    <label for="nombre">Nombre</label>
    <input class="form-control" type="text" name="nombre" value="{{isset($cliente->nombre)?$cliente->nombre:old('nombre') }}" id="nombre">
</div>

<div class="form-group">
    <label for="estado">Estado</label>
    <select class="form-control" name="estado" id="estado">
        @if (isset($cliente->estado))
        <option value="{{$cliente->estado}}" selected>{{$cliente->estado}}</option>
        <option value="">---Seleccione---</option>
        <option value="Activo">Activo</option>
        <option value="Inactivo">Inactivo</option>
        @endif

        @if (empty($cliente->estado))
        <option value="{{isset($cliente->genero)?$cliente->estado:old('estado') }}">{{isset($libro->genero)?$libro->estado:old('estado')}}</option>
        <option value="">---Seleccione---</option>
        <option value="Activo">Activo</option>
        <option value="Inactivo">Inactivo</option>
        @endif

    </select>
</div>
<br>
<input class="btn btn-success" type="submit" value="{{$modo}} cliente">

<a class="btn btn-primary" href="{{url('cliente/')}}">Volver</a>

<br>