<h1>{{ $modo }} Empleado</h1>

@if (count($errors)>0)

    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>

    </div>

@endif


<!--formulario-->

<div class="form-group">
<label for="name">Noombre</label><br>
<input class="form-control"  type="text" name="name" 
value="{{ isset($empleado->name )? $empleado->name:old('name') }}"><br>


<div class="form-group">
<label for="lastNameP">Apellido Paterno</label><br>
<input class="form-control" type="text" name="lastNameP" 
value="{{ isset($empleado->lastNameP)?$empleado->lastNameP:old('lastNameP') }}"><br>


<div class="form-group">
<label for="lastNameM">Apellido Materno</label><br>
<input class="form-control" type="text" name="lastNameM" 
value="{{ isset($empleado->lastNameM)?$empleado->lastNameM:old('lastNameM') }}"><br>


<div class="form-group">
<label for="email">Email</label><br>
<input class="form-control" type="text" name="email" 
value="{{ isset($empleado->email)?$empleado->email:old('email')}}"><br>


<label for="photo">File</label><br>
@if (isset($empleado->photo))
<img class="img-thumbnail img-fluid"  src="{{ asset('storage').'/'.$empleado->photo }}" width="100" alt=""><br>
@endif
<input type="file" name="photo" value="">
<br>
<br>

<!-- btn save date-->
<input class="btn btn-success" type="submit" value="{{ $modo }} datos">

<!--btn Register-->
<a class="btn btn-primary" href="{{ url('empleado/') }}">Regresar</a>