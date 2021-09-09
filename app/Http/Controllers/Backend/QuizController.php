<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use App\Models\ResultQuiz;


class QuizController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $quizes = Quiz::orderBy('id','desc')->get();

        return  view('backend.quizes.index',['quizes'=>$quizes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.quizes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $quiz = new Quiz();
        $quiz->titulo = $request->titulo;
        $quiz->descripcion = $request->descripcion;
        $quiz->save();

        return redirect(route('quiz.index'))
                ->with('info', 'Cuestinario creado con exito.');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $quiz =  Quiz::find($id);

        return view('backend.quizes.edit',['quiz' => $quiz]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $quiz =  Quiz::find($id);
        $quiz->titulo = $request->titulo;
        $quiz->descripcion = $request->descripcion;
        $quiz->save();

        return redirect(route('quiz.index'))
                ->with('info', 'Cuestinario actualizado con exito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        Quiz::find($request->id)->delete();
        return redirect()->route('quiz.index')->with('info','Cuestionario eliminado con éxito');
    }
}
