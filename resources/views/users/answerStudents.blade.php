@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
@section('content')


<div class="container">
<form action="{{ url('/indexStudents/'.$polls_id->id.'/answerStudents/')}}" method = "post" enctype = "multipart/form-data">
    @csrf
    @foreach($polls as $poll)
        @if($poll->id == $polls_id->id)
        {{$poll->name}}
        @break
        @endif
    @endforeach
    <div class="col-12">
    @foreach($questions as $question)   
    <label for="inputAddress" class="form-label"> 
        @foreach($polls_id as $poll_id)
        @if($poll_id == $question->poll_id && $question->poll_id == $poll->id)
            {{$question->name}}
            </label>
            <input type="text" class="form-control" name = "name" id="inputAddress" placeholder="1234 Main St">
        @endif
        @break
        @endforeach 
    @endforeach
    </div>

    <div class="col-sm-10">
   
    
    <!---@foreach($questions as $question)   
        
        @foreach($polls_id as $poll_id)
        @foreach($datosMultiplePregunta as $mulquestions)
        @if($poll_id == $question->poll_id && $question->poll_id == $poll->id && $mulquestions->question_id == $question->id)

        <div class="form-check">
        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
        <label class="form-check-label" for="gridRadios1">
        {{$mulquestions->name}}
        </label>
        </div>
        
        @endif
        @endforeach
        @break
        @endforeach 
    @endforeach
    </div>
    -->


                            
                            
                            
                           
    
        
      
    
    
       

    
</form>
</div>
@endsection