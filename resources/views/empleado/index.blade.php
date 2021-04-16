@extends('layouts.app')
@section('content')
<div class="container">

    

    @if (Session::has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>    
    @endif


<a href="{{ url('empleado/create') }}" class="btn btn-success">Registrar nuevo empleado</a>
<br>
<br>

<table>
    <thead class="table table-light">
        <tr>
            <th>#</th>
            <th>Fotos</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Correo</th>
            <th>Acciones</th> 
        </tr>
    </thead>
    <tbody>
        @foreach ($empleados as $empleado)

            <tr>
                <td>{{ $empleado->id }}</td>
                <!--image empleado-->
                <td>
                    <img class="img-thumbnail img-fluid" src=" {{ asset('storage').'/'.$empleado->photo }}" width="100" alt="">
                </td>

                <td>{{ $empleado->name }}</td>
                <td>{{ $empleado->lastNameP }}</td>
                <td>{{ $empleado->lastNameM }}</td>
                <td>{{ $empleado->email }}</td>
                <td>

                 <!--btn edit-->
                <a href="{{ url('/empleado/'.$empleado->id.'/edit') }}" class="btn btn-warning">
                    Edit
                </a>
                <!--btn delete-->
                <form action="{{ url('/empleado/'.$empleado->id) }}" method="POST"
                    class="d-inline">
                    @csrf
                    {{ method_field('DELETE') }}
                    <input type="submit" class="btn btn-danger" onclick="return confirm('¿Quieres Borrar?')"
                    value="Borrar">
                </form> 
                    
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection