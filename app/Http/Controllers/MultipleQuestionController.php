<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\MultipleQuestion;
use Illuminate\Support\Facades\DB;



class MultipleQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $multipleQuestions = MultipleQuestion::paginate(5);
        
        $datosPregunta = DB::table('questions')
        ->join('multiple_questions','questions.id',"=",'multiple_questions.question_id')
        ->select('questions.*')
        ->get();
        
        return view('multiple_questions.index', compact(['multipleQuestions', 'datosPregunta']));
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $questions = Question::all();
        return view('multiple_questions.create', compact('questions'));
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
            'name.required'=>'La pregunta múltiple es requerida',
            
        ];

        $this->validate($request, $campos, $mensaje);
        //


        
        $datosPreguntas = request()->except('_token');
        
        MultipleQuestion::create($datosPreguntas);
        return redirect('multiple_questions')->with('mensaje', 'Pregunta múltiple creada exitosamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MultipleQuestion  $multipleQuestion
     * @return \Illuminate\Http\Response
     */
    public function show(QuestionMultiple $multipleQuestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MultipleQuestion  $multipleQuestion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
        $questions = Question::all();
        $multipleQuestion = MultipleQuestion::findOrFail($id);
        return view('multiple_questions.edit', compact (['multipleQuestion', 'questions']));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MultipleQuestion  $multipleQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campos=[
            'name'=>'required|string|max:300',
        ];

        $mensaje = [
            'name.required'=>'La pregunta  múltiple es requerida',
        ];

        $this->validate($request, $campos, $mensaje);
        //
        $datosPreguntasMultiples = request()->except(['_token', '_method']);
        MultipleQuestion::where('id','=', $id)->update($datosPreguntasMultiples);

        $multipleQuestion = MultipleQuestion::findOrFail($id);
        
        //return view('polls.edit', compact ('poll'));
        return redirect('multiple_questions')->with('mensaje', 'Pregunta múltiple modificada exitosamente');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MultipleQuestion  $multipleQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        MultipleQuestion::destroy($id);
        return redirect('questions')->with('mensaje', 'Pregunta múltiple eliminada exitosamente');
    }
}

