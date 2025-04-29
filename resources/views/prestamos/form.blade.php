<h1>{{$modo}} prestamo</h1>

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
    <label for="cedula">cedula</label>
    <input class="form-control" type="text" name="cedula" value="{{isset($prestamo->cedula)?$prestamo->cedula:old('cedula') }}" id="cedula">
</div>

<div class="form-group">
    <label for="titulo">titulo</label>
    <input class="form-control" type="text" name="titulo" value="{{isset($prestamo->titulo)?$prestamo->titulo:old('titulo') }}" id="titulo">
</div>

<div class="form-group">
    <label for="fecha">fecha</label>
    <input class="form-control" type="date" name="fecha" value="{{isset($prestamo->fecha)?$prestamo->fecha:old('fecha') }}" id="fecha">
</div>

<div class="form-group">
    <label for="estado">Estado</label>
    <select class="form-control" name="estado" id="estado">
        @if (isset($prestamo->estado))
        <option value="{{$prestamo->estado}}" selected>{{$prestamo->estado}}</option>
        <option value="">---Seleccione---</option>
        <option value="Asignado">Asignado</option>
        <option value="Devuelto">Devuelto</option>
        @endif

        @if (empty($prestamo->estado))
        <option value="{{isset($prestamo->fecha)?$prestamo->estado:old('estado') }}">{{isset($prestamo->fecha)?$prestamo->estado:old('estado')}}</option>
        <option value="">---Seleccione---</option>
        <option value="Asignado">Asignado</option>
        <option value="Devuelto">Devuelto</option>
        @endif

    </select>
</div>
<br>
<input class="btn btn-success" type="submit" value="{{$modo}} prestamo">

<a class="btn btn-primary" href="{{url('prestamos/')}}">Volver</a>

<br>

