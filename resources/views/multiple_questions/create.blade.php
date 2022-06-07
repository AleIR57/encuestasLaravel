@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{ url('/multiple_questions')}}" method = "post" enctype = "multipart/form-data">
    @csrf
    @include('multiple_questions.form', ['modo'=>'Crear'])

</form>
</div>
@endsection