@extends('layouts.app')

@section('content')
<div class="container">

<form action="{{url('/prestamos/'.$prestamo->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    {{method_field('PATCH')}}

    @include('prestamos.form',['modo'=>'Modificar'])


</form>

</div>
@endsection