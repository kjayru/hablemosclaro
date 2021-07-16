<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $autores = Author::orderBy('id','asc')->get();

        return view('backend.autores.index',['autores'=>$autores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('backend.autores.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $autor = new Author();
        $autor->nombre = $request->nombre;
        $autor->titulo = $request->titulo;
        $autor->imagen = $request->imagen;
        $autor->cargo = $request->cargo;
        $autor->save();


        return redirect(route('author.index'))
        ->with('info', 'Autor creado con éxito.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $autor = Author::find($id);

        return view('backend.autores.edit',['autor' => $autor]);
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

        $autor = Author::find($id);
        $autor->nombre = $request->nombre;
        $autor->titulo = $request->titulo;
        $autor->imagen = $request->imagen;
        $autor->cargo = $request->cargo;
        $autor->save();

        return redirect(route('category.index'))
        ->with('info', 'Autor actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Author::find($request->id)->delete();
        return redirect()->route('author.index')->with('info','Autor eliminado con éxito');
    }
}
