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




<a href = "{{ url('multiple_questions/create')}}" class = "btn btn-success">Registrar nueva pregunta múltiple</a>


<table class = "table table-light">
    <thead class = "thead-light">
        <tr>
            <th>IDENTIFICACIÓN</th>
            <th>PREGUNTA MÚLTIPLE</th>
            <th>FECHA DE CREACIÓN</th>
            <th>FECHA DE ACTUALIZACIÓN</th>
            <th>NOMBRE DE PREGUNTA</th>
            <th>ACCIONES</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $multipleQuestions as $mulquestion)
        <tr>
            <td>{{ $mulquestion->id }}</td>
            <td>{{ $mulquestion->name }}</td>
            <td>{{ $mulquestion->created_at }}</td>
            <td>{{ $mulquestion->updated_at }}</td>
            <td>@foreach( $datosPregunta as $pregunta)
                @if($mulquestion->question_id == $pregunta->id)
                {{$pregunta->name}}
                @break
                @endif
                @endforeach</td>
            <td>
                
            <a href="{{ url('/multiple_questions/'.$mulquestion->id.'/edit') }}" class = "btn btn-primary">
                Editar
            </a>
             | 

            <form action="{{ url('/multiple_questions/'.$mulquestion->id) }}" method = "post">
            @csrf
            {{ method_field('DELETE') }}
            <input class = "btn btn-danger" type="submit" onclick = "return confirm('¿Deseas borrar esta pregunta múltiple?')" value = "Borrar">

            </form>
            </td>
        </tr>
        @endforeach

        
    </tbody>
</table>
{!! $multipleQuestions->links() !!}
</div>
@endsection