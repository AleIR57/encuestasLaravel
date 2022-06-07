    
    
   <h1> {{ $modo }} usuario </h1>

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
    <input type="text" class = "form-control" name = "name" placeholder = "Nombre" id = "name" value = "{{ isset($user->name)?$user->name:old('name') }}">
    </div>
    
    <div class = "form-group">
    <input type="email" class = "form-control" name = "email" placeholder = "Correo" id = "email" value = "{{ isset($user->email)?$user->email:old('email') }}">
    </div>
    <div class = "form-group">
    <input type="text" class = "form-control" name = "password" placeholder = "Contraseña" id = "password" value = "{{ isset($user->password)?$user->password:old('password') }}">
    </div>
    <div class = "form-group">
    <label for="estudent">Estudiante</label>
    <input type="radio"  class = "form-control" name = "rol_id" placeholder = "Estudiante" id = "estudent" value = "1">
    </div>
    <div class = "form-group">
    <label for="admin">Administrador</label>
    <input type="radio" class = "form-control" name = "rol_id" placeholder = "Administrador" id = "admin" value = "2">
    </div>
    <input  class = "btn btn-success" type="submit" value = "{{ $modo }} datos">

    <a class = "btn btn-primary" href = "{{ url('users/')}}">Regresar</a>