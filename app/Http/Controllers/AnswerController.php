<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\User;
use App\Models\Answer;
use Illuminate\Support\Facades\DB;



class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $answers = Answer::paginate(5);
        
        $datosPregunta = DB::table('questions')
        ->join('answers','questions.id',"=",'answers.question_id')
        ->select('questions.*')
        ->get();

        $datosUsuario = DB::table('users')
        ->join('answers','users.id',"=",'answers.user_id')
        ->select('users.*')
        ->get();
        
        return view('answers.index', compact(['answers', 'datosPregunta', 'datosUsuario']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $answers = Answer::all();
        $users = User::all();
        $questions = Question::all();
        
        return view('answers.create', compact(['answers', 'users', 'questions']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Answer $answer
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos=[
            'name'=>'required|string|max:300',
        ];

        $mensaje = [
            'name.required'=>'La respuesta es requerida',
            
        ];

        $this->validate($request, $campos, $mensaje);
        //


        
        $datosRespuestas = request()->except('_token');
        
        Answer::create($datosRespuestas);
        return redirect('answers')->with('mensaje', 'Respuesta agregada exitosamente');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Answer $answer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datosPregunta = DB::table('questions')
        ->join('answers','questions.id',"=",'answers.question_id')
        ->select('questions.*')
        ->get();
        $questions = Question::all();
        $answer = Answer::findOrFail($id);
        return view('answers.edit', compact (['answer', 'polls', 'datosPregunta']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Answer $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campos=[
            'name'=>'required|string|max:300',
        ];

        $mensaje = [
            'name.required'=>'La pregunta es requerida',
        ];

        $this->validate($request, $campos, $mensaje);
        //
        $datosRespuestas = request()->except(['_token', '_method']);
        Answer::where('id','=', $id)->update($datosRespuestas);

        $answer = Answer::findOrFail($id);
        
        //return view('polls.edit', compact ('poll'));
        return redirect('answers')->with('mensaje', 'Respuesta modificada exitosamente');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        
        Answer::destroy($id);
        return redirect('answers')->with('mensaje', 'Pregunta eliminada exitosamente');
    }
}

