@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{ url('/multiple_questions/'.$multipleQuestion->id) }}" method = "post" enctype = "multipart/form-data">
@csrf
{{ method_field('PATCH') }}
@include('multiple_questions.form', ['modo'=>'Editar'])
</form>
</div>
@endsection
