<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poll;
use App\Models\User;
use Illuminate\Support\Facades\DB;



class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $polls = Poll::paginate(5);
        
        $datosUsuario = DB::table('users')
        ->join('polls','users.id',"=",'polls.user_id')
        ->select('users.*')
        ->get();
        
        return view('polls.index', compact(['polls', 'datosUsuario']));

    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('polls.create', compact('users'));

        
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
            'description'=>'required|string|max:500',
        ];

        $mensaje = [
            'name.required'=>'El nombre es requerido',
            'description.required'=>'La descripción es requerida',
        ];

        $this->validate($request, $campos, $mensaje);
        //


        
        $datosEncuestas = request()->except('_token');
        
        Poll::create($datosEncuestas);
        return redirect('polls')->with('mensaje', 'Encuesta creada exitosamente');
        return view('polls.create', compact('users'));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function show(Poll $poll)
    {
        
        return view('polls.edit', compact('datosPregunta'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
        $users = User::all();
        $poll = Poll::findOrFail($id);
        
        return view('polls.edit', compact (['poll', 'users']));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campos=[
            'name'=>'required|string|max:100',
            'description'=>'required|string|max:500',
        ];

        $mensaje = [
            'name.required'=>'El nombre es requerido',
            'description.required'=>'La descripción es requerida',
        ];

        $this->validate($request, $campos, $mensaje);
        //
        $datosEncuestas = request()->except(['_token', '_method']);
        Poll::where('id','=', $id)->update($datosEncuestas);

        $poll = Poll::findOrFail($id);
        
        //return view('polls.edit', compact ('poll'));
        return redirect('polls')->with('mensaje', 'Encuesta modificada exitosamente');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        
        Poll::destroy($id);
        return redirect('polls')->with('mensaje', 'Encuesta eliminada exitosamente');
    }
}

