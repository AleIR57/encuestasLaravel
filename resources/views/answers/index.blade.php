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




<a href = "{{ url('answers/create')}}" class = "btn btn-success">Registrar nueva respuesta</a>


<table class = "table table-light">
    <thead class = "thead-light">
        <tr>
            <th>IDENTIFICACIÓN</th>
            <th>RESPUESTA</th>
            <th>FECHA DE CREACIÓN</th>
            <th>FECHA DE ACTUALIZACIÓN</th>
            <th>NOMBRE DE LA PREGUNTA</th>
            <th>NOMBRE DEL USUARIO</th>
            <th>ACCIONES</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $answers as $answer)
        <tr>
            <td>{{ $answer->id }}</td>
            <td>{{ $answer->name }}</td>
            <td>{{ $answer->created_at }}</td>
            <td>{{ $answer->updated_at }}</td>
            
            <td>@foreach( $datosPregunta as $pregunta)
                @if($answer->question_id == $pregunta->id)
                {{$pregunta->name}}
                @break
                @endif
                @endforeach</td>
            
            <td>@foreach( $datosUsuario as $usuario)
                @if($answer->user_id == $usuario->id)
                {{$usuario->name}}
                @break
                @endif
                @endforeach</td>
            
            <td>
                
            <a href="{{ url('/answers/'.$answer->id.'/edit') }}" class = "btn btn-primary">
                Editar
            </a>
             | 
            <form action="{{ url('/answers/'.$answer->id) }}"  method = "post">
            @csrf
            {{ method_field('DELETE') }}
            <input class = "btn btn-danger"  type="submit" onclick = "return confirm('¿Deseas borrar esta respuesta?')" value = "Borrar">
                 
            </form>
            </td>
        </tr>
        @endforeach

        
    </tbody>
</table>
{!! $answers->links() !!}
</div>
@endsection