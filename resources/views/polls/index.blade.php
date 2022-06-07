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




<a href = "{{ url('polls/create')}}" class = "btn btn-success">Registrar nueva encuesta</a>


<table class = "table table-light">
    <thead class = "thead-light">
        <tr>
            <th>IDENTIFICACIÓN</th>
            <th>NOMBRE</th>
            <th>DESCRIPCIÓN</th>
            <!--<th>CONTRASEÑA</th>-->
            <th>FECHA DE CREACIÓN</th>
            <th>FECHA DE ACTUALIZACIÓN</th>
            <th>NOMBRE DE USUARIO</th>
            <th>ACCIONES</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $polls as $poll)
        <tr>
            <td>{{ $poll->id }}</td>
            <td>{{ $poll->name }}</td>
            <td>{{ $poll->description }}</td>
            <!--<td>{{ $poll->password }}</td>-->
            <td>{{ $poll->created_at }}</td>
            <td>{{ $poll->updated_at }}</td>
            <td>@foreach( $datosUsuario as $usuario)
                @if($poll->user_id == $usuario->id)
                {{$usuario->name}}
                @break
                @endif
                @endforeach</td>
            <td>
                
            <a href="{{ url('/polls/'.$poll->id.'/edit') }}" class = "btn btn-primary">
                Editar
            </a>
            
             | 

             <a href="{{ url('/answers/') }}" class = "btn btn-secondary">
                Respuestas
            </a>

             | 

            <form action="{{ url('/polls/'.$poll->id) }}"  method = "post">
            @csrf
            {{ method_field('DELETE') }}
            <input class = "btn btn-danger" type="submit" onclick = "return confirm('¿Deseas borrar esta encuesta?')" value = "Borrar">
            
            </form>
        
            </td>
        </tr>
        @endforeach

        
    </tbody>
</table>
{!! $polls->links() !!}
</div>
@endsection