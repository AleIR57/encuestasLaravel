    
    
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
    <input type="text" class = "form-control" name = "name" placeholder = "Nombre" id = "name" value = "{{ isset($poll->name)?$poll->name:old('name') }}">
    </div>
    <div class = "form-group">
    <textarea class = "form-control" name = "description" placeholder = "Descripción" id = "description">{{ isset($poll->description)?$poll->description:old('description') }}</textarea>
    </div>
    <div class = "form-group">
    <div class = "form-group">
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

    <a class = "btn btn-primary" href = "{{ url('polls/')}}">Regresar</a>