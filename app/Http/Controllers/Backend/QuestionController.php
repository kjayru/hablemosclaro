<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {


        return view('backend.questions.create',['quiz_id'=>$id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $preg = new Question();
        $preg->pregunta = $request->pregunta;
        $preg->quiz_id = $request->quiz_id;
        if(isset($request->imagen)){
            $preg->imagen = $request->imagen;
        }
        $preg->save();

        return redirect(route('question.show',['ques'=>$request->quiz_id]))
       ->with('info', 'Pregunta creada con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $questions = Question::where('quiz_id',$id)->get();

        return view('backend.questions.index',['questions'=>$questions,'quiz_id'=>$id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$quiz_id)
    {
        $question = Question::find($id);

        return view('backend.questions.edit',['quiz_id'=>$quiz_id,'question'=>$question]);
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

        $preg =  Question::find($id);

        $preg->pregunta = $request->pregunta;
        $preg->quiz_id = $request->quiz_id;
        if(isset($request->imagen)){
            $preg->imagen = $request->imagen;
        }
        $preg->save();

        return redirect(route('question.show',['ques'=>$request->quiz_id]))
       ->with('info', 'Pregunta actualizada con exito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
         Question::find($request->id)->delete();
        return redirect()->route('question.show',['ques'=>$request->quiz_id])->with('info','Pregunta eliminado con éxito');
    }
}
