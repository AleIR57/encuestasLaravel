@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{ url('/polls')}}" method = "post" enctype = "multipart/form-data">
    @csrf
    @include('polls.form', ['modo'=>'Crear'])

</form>
</div>
@endsection