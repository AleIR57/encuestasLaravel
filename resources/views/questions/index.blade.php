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




<a href = "{{ url('questions/create')}}" class = "btn btn-success">Registrar nueva pregunta</a>


<table class = "table table-light">
    <thead class = "thead-light">
        <tr>
            <th>IDENTIFICACIÓN</th>
            <th>PREGUNTA</th>
            <th>FECHA DE CREACIÓN</th>
            <th>FECHA DE ACTUALIZACIÓN</th>
            <th>NOMBRE DE LA ENCUESTA</th>
            <th>ACCIONES</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $questions as $question)
        <tr>
            <td>{{ $question->id }}</td>
            <td>{{ $question->name }}</td>
            <td>{{ $question->created_at }}</td>
            <td>{{ $question->updated_at }}</td>
            
            <td>@foreach( $datosEncuesta as $encuesta)
                @if($question->poll_id == $encuesta->id)
                {{$encuesta->name}}
                @break
                @endif
                @endforeach</td>
            
            <td>
                
            <a href="{{ url('/questions/'.$question->id.'/edit') }}" class = "btn btn-primary">
                Editar
            </a>
             | 
            <form action="{{ url('/questions/'.$question->id) }}"  method = "post">
            @csrf
            {{ method_field('DELETE') }}
            <input class = "btn btn-danger"  type="submit" onclick = "return confirm('¿Deseas borrar esta pregunta?')" value = "Borrar">
                 
            </form>
            </td>
        </tr>
        @endforeach

        
    </tbody>
</table>
{!! $questions->links() !!}
</div>
@endsection