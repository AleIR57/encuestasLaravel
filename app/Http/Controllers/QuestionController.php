<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poll;
use App\Models\Question;
use Illuminate\Support\Facades\DB;



class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $questions = Question::paginate(5);
        
        $datosEncuesta = DB::table('polls')
        ->join('questions','polls.id',"=",'questions.poll_id')
        ->select('polls.*')
        ->get();
        
        return view('questions.index', compact(['questions', 'datosEncuesta']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $polls = Poll::all();
        
        return view('questions.create', compact('polls'));
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
            'name'=>'required|string|max:300',
        ];

        $mensaje = [
            'name.required'=>'La pregunta es requerida',
            
        ];

        $this->validate($request, $campos, $mensaje);
        //


        
        $datosPreguntas = request()->except('_token');
        
        Question::create($datosPreguntas);
        return redirect('questions')->with('mensaje', 'Pregunta creada exitosamente');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datosEncuesta = DB::table('polls')
        ->join('questions','polls.id',"=",'questions.poll_id')
        ->select('polls.*')
        ->get();
        $polls = Poll::all();
        $question = Question::findOrFail($id);
        return view('questions.edit', compact (['question', 'polls', 'datosEncuesta']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
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
        $datosPreguntas = request()->except(['_token', '_method']);
        Question::where('id','=', $id)->update($datosPreguntas);

        $question = Question::findOrFail($id);
        
        //return view('polls.edit', compact ('poll'));
        return redirect('questions')->with('mensaje', 'Pregunta modificada exitosamente');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        
        Question::destroy($id);
        return redirect('questions')->with('mensaje', 'Pregunta eliminada exitosamente');
    }
}

