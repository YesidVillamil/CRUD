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

    <a href="{{url('libro/create')}}" class="btn btn-success">Crear libro</a>
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
            @foreach($libros as $libro)
            <tr>
                <td>{{$libro->id}}</td>

                <td>{{$libro->titulo}}</td>
                <td>{{$libro->autor}}</td>
                <td>{{$libro->genero}}</td>
                <td>{{$libro->estado}}</td>
                <td>
                    <a href="{{url('/libro/'.$libro->id.'/edit')}}" class="btn btn-warning">
                        Modificar
                    </a> |

                    <form action="{{url('/libro/'.$libro->id)}}" class="d-inline" method="post">
                        @csrf
                        {{ method_field('DELETE')}}
                        <input class="btn btn-danger" type="submit" onclick="return confirm('¿Desea eliminar?')" value="Eliminar">
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!!$libros->links()!!}
</div>
@endsection