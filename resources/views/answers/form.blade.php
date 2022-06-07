    
    
   <h1> {{ $modo }} respuesta </h1>

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
    <input type="text" class = "form-control" name = "name" placeholder = "Nombre" id = "name" value = "{{ isset($answer->name)?$answer->name:old('name') }}">
    </div>
    <div class = "form-group">
        
  
    <label for="user">Pregunta</label>
    <select name = "question_id">
       @foreach($questions as $question) 
       <option value = "{{$question->id}}">
            {{$question->name}}
       </option>
         @endforeach
    </select>
    <label for="user">Usuario</label>
    <select name = "user_id">
       @foreach($users as $user) 
       <option value = "{{$user->id}}">
            {{$user->name}}
       </option>
         @endforeach
    </select>
    </div>
    <input  class = "btn btn-success" type="submit" value = "{{ $modo }} datos">

    <a class = "btn btn-primary" href = "{{ url('answers/')}}">Regresar</a>