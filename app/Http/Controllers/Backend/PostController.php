<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Support\Str;
use App\Models\Tag;

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
        $tags = Tag::orderBy('nombre','asc')->get();
        $cats=[];
        return view('backend.publicaciones.create',[ 'cats'=>$cats,'categories'=>$categories,'authors'=>$authors,'tags'=>$tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


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
        //$post->category_id = $request->categoria_blog_id;
        $post->post_type_id = $request->tipo_id;
        $post->meta_titulo = $request->seotitle;
        $post->meta_image = $request->imageMeta;
        $post->meta_description = $request->seodescripcion;
        $post->meta_keywords = $request->keywords;
        $post->video = $request->video;
        $post->date_publish = $request->fechapublicacion;
        $post->author_id = $request->author;
        $post->save();
       // $post->authors()->sync($request->author);

        $post->categories()->sync($request->category);
        $post->tags()->sync($request->tags);

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
        $tags = Tag::orderBy('nombre','asc')->get();
        $cats=[];
       foreach($articulo->categories as $cat){
        $cats[] = $cat->id;
       }


        return view('backend.publicaciones.edit',['cats'=>$cats,'articulo'=>$articulo,'categories'=>$categories,'authors'=>$authors,'tags'=>$tags]);
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



        $post = Post::find($id);
        $post->titulo  = $request->titulo;
        $post->slug =  Str::slug($request->titulo, '-');
        $post->contenido = $request->contenido;
        if($request->imageBanner){
        $post->banner = $request->imageBanner;
        }
        if($request->imageTablet){
        $post->tablet = $request->imageTablet;
        }
        if($request->imageMovil){
            $post->movil = $request->imageMovil;
        }
        if($request->imageCard){
        $post->imagenbox = $request->imageCard;
        }
        $post->destacado = $request->destacado;
        $post->estado = $request->estado;
        //$post->category_id = $request->categoria_blog_id;
        $post->post_type_id = $request->tipo_id;
        $post->meta_titulo = $request->seotitle;
        if($request->imageMeta){
        $post->meta_image = $request->imageMeta;
        }
        $post->meta_description = $request->seodescripcion;
        $post->meta_keywords = $request->keywords;
        $post->video = $request->video;
        $post->date_publish =  $request->fechapublicacion;
        $post->author_id = $request->author;

        $post->save();

        //$post->authors()->sync($request->author);
        $post->tags()->sync($request->tags);
        $post->categories()->sync($request->category);

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
