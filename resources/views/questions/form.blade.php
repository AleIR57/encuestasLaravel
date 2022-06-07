    
    
   <h1> {{ $modo }} pregunta </h1>

   @if(count($errors)>0)
         <div class = "alert alert-danger" roler = "alert">
            <ul>

            @foreach( $errors->all() as $errors)
            <li>{{ $errors }}</li>
            @endforeach
            <ul>
         </div>
    
      
   @endif

   
    <div class = "form-group">
    <input type="text" class = "form-control" name = "name" placeholder = "Nombre" id = "name" value = "{{ isset($question->name)?$question->name:old('name') }}">
    </div>
    <div class = "form-group">
        
  
    <label for="user">Encuesta</label>
    <select name = "poll_id">
       @foreach($polls as $poll) 
       <option value = "{{$poll->id}}">
            {{$poll->name}}
       </option>
         @endforeach
    </select>
    </div>
    <input  class = "btn btn-success" type="submit" value = "{{ $modo }} datos">

    <a class = "btn btn-primary" href = "{{ url('questions/')}}">Regresar</a>