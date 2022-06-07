@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{ url('/answers')}}" method = "post" enctype = "multipart/form-data">
    @csrf
    @include('answers.form', ['modo'=>'Crear'])

</form>
</div>
@endsection