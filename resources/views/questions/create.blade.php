@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{ url('/questions')}}" method = "post" enctype = "multipart/form-data">
    @csrf
    @include('questions.form', ['modo'=>'Crear'])

</form>
</div>
@endsection