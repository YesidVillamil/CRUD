@extends('layouts.app')

@section('content')
<div class="container">

<form action="{{url('/prestamos')}}" method="post" enctype="multipart/form-data">
    @csrf
    @include('prestamos.form',['modo'=>'Crear'])
</form>

</div>
@endsection