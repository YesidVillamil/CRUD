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

    <a href="{{url('cliente/create')}}" class="btn btn-success">Crear cliente</a>
    <br />
    <br />
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
            <tr>
                <td>{{$cliente->id}}</td>

                <td>{{$cliente->cedula}}</td>
                <td>{{$cliente->nombre}}</td>
                <td>{{$cliente->estado}}</td>
                <td>
                    <a href="{{url('/cliente/'.$cliente->id.'/edit')}}" class="btn btn-warning">
                        Modificar
                    </a> |

                    <form action="{{url('/cliente/'.$cliente->id)}}" class="d-inline" method="post">
                        @csrf
                        {{ method_field('DELETE')}}
                        <input class="btn btn-danger" type="submit" onclick="return confirm('¿Desea eliminar?')" value="Eliminar">
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!!$clientes->links()!!}
</div>
@endsection