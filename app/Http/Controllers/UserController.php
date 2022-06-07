<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Poll;
use App\Models\Question;
use App\Models\MultipleQuestion;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(5);
        
        $datosRol = DB::table('rols')
        ->join('users','rols.id',"=",'users.rol_id')
        ->select('rols.*')
        ->get();
        
        return view('users.index', compact(['users', 'datosRol']));
      
    }

    public function indexStudents()
    {

        $polls = Poll::paginate(5);
        
        $datosUsuario = DB::table('users')
        ->join('polls','users.id',"=",'polls.user_id')
        ->select('users.*')
        ->get();
        
        return view('users.indexStudents', compact(['polls', 'datosUsuario']));
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    public function answerStudents($id)
    {
        $polls = Poll::all();
        $questions = Question::all();
        $datosMultiplePregunta = MultipleQuestion::all();
        $polls_id = Poll::find($id);
        


        return view('users.answerStudents', compact(['polls', 'questions', 'datosMultiplePregunta', 'polls_id']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos=[
            'name'=>'required|string|max:100',
            'email'=>'required|email',
            'password'=>'required|max:50',
            'rol_id'=>'required|in:1,2',
        ];

        $mensaje = [
            'name.required'=>'El nombre es requerido',
            'email.required'=>'El correo es requerido',
            'password.required'=>'La contraseña es requerida',
            'rol_id.required'=>'El rol de la persona es requerido'
        ];

        $this->validate($request, $campos, $mensaje);
        //
        //$datosUsuario = request()->all();
        $datosUsuario = request()->except('_token');
        User::create($datosUsuario);
        return redirect('users')->with('mensaje', 'Usuario creado exitosamente');

        
    }

    public function storeStudents(Request $request)
    {
        $campos=[
            'name'=>'required|string|max:100',
            'email'=>'required|email',
            'password'=>'required|max:50',
            'rol_id'=>'required|in:1,2',
        ];

        $mensaje = [
            'name.required'=>'El nombre es requerido',
            'email.required'=>'El correo es requerido',
            'password.required'=>'La contraseña es requerida',
            'rol_id.required'=>'El rol de la persona es requerido'
        ];

        $this->validate($request, $campos, $mensaje);
        //
        //$datosUsuario = request()->all();
        $datosUsuario = request()->except('_token');
        User::create($datosUsuario);
        return redirect('users')->with('mensaje', 'Usuario creado exitosamente');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact ('user'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campos=[
            'name'=>'required|string|max:100',
            'email'=>'required|email',
            'password'=>'required|max:100',
            'rol_id'=>'required|in:1,2',
        ];

        $mensaje = [
            'name.required'=>'El nombre es requerido',
            'email.required'=>'El correo es requerido',
            'password.required'=>'La contraseña es requerida',
            'rol_id.required'=>'El rol de la persona es requerido'
        ];

        $this->validate($request, $campos, $mensaje);
        //
        $datosUsuario = request()->except(['_token', '_method']);
        User::where('id','=', $id)->update($datosUsuario);

        $user = User::findOrFail($id);
        //return view('users.edit', compact ('user'));
        return redirect('users')->with('mensaje', 'Usuario modificado exitosamente');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        User::destroy($id);
        return redirect('users')->with('mensaje', 'Usuario eliminado exitosamente');
    }
}

