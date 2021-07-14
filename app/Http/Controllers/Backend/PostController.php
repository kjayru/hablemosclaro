<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Support\Str;

class PostController extends Controller
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
        $articulos = Post::orderBy('id','desc')->get();
        return view('backend.publicaciones.index',['articulos'=>$articulos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('id','desc')->get();
        $authors = Author::orderBy('nombre','asc')->get();
        return view('backend.publicaciones.create',['categories'=>$categories,'authors'=>$authors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $fecha = $request->fechapublicacion;
        $fp = explode("/",$fecha);

        $nfp= $fp[2]."-".$fp[1]."-".$fp[0];

        $post = new Post();
        $post->titulo  = $request->titulo;
        $post->slug =  Str::slug($request->titulo, '-');
        $post->contenido = $request->contenido;
        $post->banner = $request->imageBanner;
        $post->tablet = $request->imageTablet;
        $post->movil = $request->imageMovil;
        $post->imagenbox = $request->imageCard;
        $post->destacado = $request->destacado;
        $post->estado = $request->estado;
        $post->category_id = $request->categoria_blog_id;
        $post->post_type_id = $request->tipo_id;
        $post->meta_titulo = $request->seotitle;
        $post->meta_image = $request->imageMeta;
        $post->meta_description = $request->seodescripcion;
        $post->meta_keywords = $request->keywords;
        $post->video = $request->video;
        $post->date_publish = $nfp;

        $post->save();
        $post->authors()->sync($request->author);

        return redirect(route('post.index'))
        ->with('info', 'Artículo actualizado con exito.');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $articulo = Post::find($id);
        $categories = Category::orderBy('id','desc')->get();
        $authors = Author::orderBy('nombre','asc')->get();
        return view('backend.publicaciones.edit',['articulo'=>$articulo,'categories'=>$categories,'authors'=>$authors]);
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

        $fecha = $request->fechapublicacion;
        $fp = explode("/",$fecha);

        $nfp= $fp[2]."-".$fp[1]."-".$fp[0];

        $post = Post::find($id);
        $post->titulo  = $request->titulo;
        $post->slug =  Str::slug($request->titulo, '-');
        $post->contenido = $request->contenido;
        $post->banner = $request->imageBanner;
        $post->tablet = $request->imageTablet;
        $post->movil = $request->imageMovil;
        $post->imagenbox = $request->imageCard;
        $post->destacado = $request->destacado;
        $post->estado = $request->estado;
        $post->category_id = $request->categoria_blog_id;
        $post->post_type_id = $request->tipo_id;
        $post->meta_titulo = $request->seotitle;
        $post->meta_image = $request->imageMeta;
        $post->meta_description = $request->seodescripcion;
        $post->meta_keywords = $request->keywords;
        $post->video = $request->video;
        $post->date_publish = $nfp;

        $post->save();


        $post->authors()->sync($request->author);



        return redirect(route('post.index'))
        ->with('info', 'Artículo actualizado con exito.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Post::find($request->id)->delete();
        return redirect()->route('post.index')->with('info','Artículo eliminado con éxito');
    }
}
