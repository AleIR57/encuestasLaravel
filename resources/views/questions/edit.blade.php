@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{ url('/questions/'.$question->id) }}" method = "post" enctype = "multipart/form-data">
@csrf
{{ method_field('PATCH') }}
@include('questions.form', ['modo'=>'Editar'])
</form>
</div>
@endsection
