@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{ url('/polls/'.$poll->id) }}" method = "post" enctype = "multipart/form-data">
@csrf
{{ method_field('PATCH') }}
@include('polls.form', ['modo'=>'Editar'])

</form>
</div>
@endsection
