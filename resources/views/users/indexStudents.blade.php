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



<table class = "table table-light">
    <thead class = "thead-light">
        <tr>
            <th>NOMBRE</th>
            <th>DESCRIPCIÓN</th>
            <!--<th>CONTRASEÑA</th>-->
            <th>FECHA DE CREACIÓN</th>
            <th>FECHA DE ACTUALIZACIÓN</th>
            <th>ACCIONES</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $polls as $poll)
            
        <tr>
            <td>{{ $poll->name }}</td>
            <td>{{ $poll->description }}</td>
            <!--<td>{{ $poll->password }}</td>-->
            <td>{{ $poll->created_at }}</td>
            <td>{{ $poll->updated_at }}</td>
            <!--<td>@foreach( $datosUsuario as $usuario)
                @if($poll->user_id == $usuario->id)
                {{$usuario->name}}
                @break
                @endif
                @endforeach</td>-->
            <td>
                
            <a href="{{ url('/indexStudents/'.$poll->id.'/answerStudents')}}" class = "btn btn-success">
                Responder
            </a>

            </td>
        </tr>
        @endforeach

        
    </tbody>
</table>
{!! $polls->links() !!}
</div>
@endsection