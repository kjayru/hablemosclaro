<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
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
        $categories = Category::orderBy('id','desc')->get();
        return view('backend.categorias.index',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')->orderBy('id','desc')->get();

        return view('backend.categorias.create',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       $category = new Category();
       $category->nombre = $request->nombre;
       $category->slug =  Str::slug($request->nombre, '-');
       $category->parent_id = $request->parent_id;
       $category->save();

       return redirect(route('category.index'))
       ->with('info', 'Categoría creada con exito.');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        $categories = Category::whereNull('parent_id')->orderBy('id','desc')->get();
        return view('backend.categorias.edit',['category'=>$category,'categories'=>$categories]);
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
        $category =  Category::find($id);
        $category->nombre = $request->nombre;
        $category->slug =  Str::slug($request->nombre, '-');
        $category->parent_id = $request->parent_id;
        $category->save();


        return redirect(route('category.index'))
       ->with('info', 'Categoría actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Category::find($request->id)->delete();
        return redirect()->route('category.index')->with('info','Categoría eliminado con éxito');
    }
}
