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
    <label for="cedula">Cédula</label>
    <select class="form-control" name="cedula" id="cedula">
        <option value="">---Seleccione---</option>
        @foreach($clientes as $cliente)
            <option value="{{$cliente->cedula}}" 
                @if(isset($prestamo->cedula) && $prestamo->cedula == $cliente->cedula) selected 
                @elseif(old('cedula') == $cliente->cedula) selected 
                @endif>
                {{$cliente->cedula}} - {{$cliente->nombre}} {{-- si tienes nombre --}}
            </option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="titulo">Título del libro</label>
    <select name="titulo" id="titulo" class="form-control">
        <option value="">---Seleccione un libro---</option>
        @foreach ($libros as $libro)
            <option 
                value="{{ $libro->titulo }}" 
                {{ (isset($prestamo->titulo) && $prestamo->titulo == $libro->titulo) ? 'selected' : '' }}
                {{ $libro->estado === 'Prestado' ? 'disabled' : '' }}
            >
                {{ $libro->titulo }} 
                {{ $libro->estado === 'Prestado' ? '(Prestado)' : '' }}
            </option>
        @endforeach
    </select>
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

