@extends('layouts.app')

@section('content')
<div class="container">

    @if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{Session::get('mensaje')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
    </div>
    @endif

    <a href="{{url('prestamos/create')}}" class="btn btn-success">Asignar libro</a>
    <br />
    <br />
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Titulo</th>
                <th>Autor</th>
                <th>Genero</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prestamos as $prestamo)
            <tr>
                <td>{{$prestamo->id}}</td>

                <td>{{$prestamo->cedula}}</td>
                <td>{{$prestamo->titulo}}</td>
                <td>{{$prestamo->fecha}}</td>
                <td>{{$prestamo->estado}}</td>
                <td>
                    <a href="{{url('/prestamos/'.$prestamo->id.'/edit')}}" class="btn btn-warning">
                        Modificar
                    </a> |

                    <form action="{{url('/prestamos/'.$prestamo->id)}}" class="d-inline" method="post">
                        @csrf
                        {{ method_field('DELETE')}}
                        <input class="btn btn-danger" type="submit" onclick="return confirm('¿Desea eliminar?')" value="Eliminar">
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!!$prestamos->links()!!}
</div>
@endsection