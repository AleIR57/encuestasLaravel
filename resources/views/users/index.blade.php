@extends('layouts.app')

@section('content')
<div class="container">


@if(Session::has('mensaje'))
<div class = "alert alert-success alert-dismissible" role = "alert">
{{ Session::get('mensaje') }}
<button type = "button" class = "close" data-dismiss = "alert" aria-label = "Close">
    <span aria-hidden = "true">&times;</span>
</button>
</div>
@endif




<a href = "{{ url('users/create')}}" class = "btn btn-success">Registrar nuevo usuario</a>


<table class = "table table-light">
    <thead class = "thead-light">
        <tr>
            <th>IDENTIFICACIÓN</th>
            <th>NOMBRE</th>
            <th>CORREO</th>
            <!--<th>CONTRASEÑA</th>-->
            <th>FECHA DE CREACIÓN</th>
            <th>FECHA DE ACTUALIZACIÓN</th>
            <th>ROL</th>
            <th>ACCIONES</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <!--<td>{{ $user->password }}</td>-->
            <td>{{ $user->created_at }}</td>
            <td>{{ $user->updated_at }}</td>
            <td>@foreach( $datosRol as $rol)
                @if($user->rol_id == $rol->id)
                {{$rol->name}}
                @break
                @endif
                @endforeach</td>
            <td>
                
            <a href="{{ url('/users/'.$user->id.'/edit') }}" class = "btn btn-primary">
                Editar
            </a>
             | 

            <form action="{{ url('/users/'.$user->id) }}" class = "d-inline" method = "post">
            @csrf
            {{ method_field('DELETE') }}
            <input class = "btn btn-danger" type="submit" onclick = "return confirm('¿Deseas borrar este usuario?')" value = "Borrar">

            </form>
            </td>
        </tr>
        @endforeach

        
    </tbody>
</table>
{!! $users->links() !!}
</div>
@endsection