<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Option;
use App\Models\ResultQuiz;

class OptionController extends Controller
{




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $option = new Option();
        $option->opcion = $request->option;
        $option->question_id = $request->question_id;
        $option->save();

        return response()->json($option);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $opciones = Option::where('question_id',$id)->get();

        return response()->json($opciones);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $opcion = Option::find($id);

        return response()->json($opcion);
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

        $option =  Option::find($id);
        $option->opcion = $request->option;
        $option->question_id = $request->question_id;
        $option->save();


        $opciones = Option::where('question_id',$request->question_id)->get();

        return response()->json($opciones);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Option::find($request->id)->delete();

       $opciones =  Option::where('question_id',$request->question_id)->orderBy('opcion','asc')->get();

        return response()->json($opciones);
    }


    public function setResult(Request $request){

        $result = ResultQuiz::where('quiz_id',$request->quiz_id)
        ->where('question_id',$request->question_id)->first();

        if(isset($result)){

            $result->quiz_id = $request->quiz_id;
            $result->question_id = $request->question_id;
            $result->option_id = $request->option_id;
            $result->save();

        }else{
            $res = new ResultQuiz();
            $res->quiz_id = $request->quiz_id;
            $res->question_id = $request->question_id;
            $res->option_id = $request->option_id;
            $res->save();
        }

        return response()->json(['rpta'=>'ok']);
    }

    public function getResult(Request $request){

         $result = ResultQuiz::where('quiz_id',$request->quiz_id)
        ->where('question_id',$request->question_id)->first();

        return response()->json($result);
    }
}
