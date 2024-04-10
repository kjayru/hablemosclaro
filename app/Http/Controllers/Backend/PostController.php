<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Support\Str;
use App\Models\Tag;
use App\Models\Quiz;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
        $itags=[];
        $iquiz=[];
        $quizes = Quiz::orderBy('titulo')->get();


        return view('backend.publicaciones.create',['iquiz'=>$iquiz,'quizes'=>$quizes,'itags'=>$itags,'cats'=>$cats,'categories'=>$categories,'authors'=>$authors,'tags'=>$tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //   $validated = $request->validate([
        //     'titulo' => 'required',
        //     'contenido' => 'required',
        //     'imageBanner' => 'required',
        //     'imageCard' => 'required',

        // ]);



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
        $post->quiz_id = $request->quiz;
        $post->save();
       // $post->authors()->sync($request->author);

        $post->categories()->sync($request->category);
        $post->tags()->sync($request->tags);

            $pariente=null;
          $baseurl= 'https://www.claro.com.pe/hablando-claro';

        foreach($request->category as $cat){
            if(Category::where('id',$cat)->whereNull('parent_id')->first()){
                $categorias[] = $cat;
            }else{
                $subcategorias[]=$cat;
            }
        }

        foreach($subcategorias as $sub){
           $scat =  Category::where('id',$sub)->first();

           //remitir post
            $urlfinal = $baseurl."/".$scat->parent->slug."/".$scat->slug."/post/?=".Str::slug($request->titulo, '-');

            $getdata = Http::asForm()->post('https://api-prod-pe.prod.clarodigital.net/api/PE_MS_FE_POSTS/createPost',
                [
                    'url' => $urlfinal,
                ]);


                Log::info($getdata->successful());

               // dd($getdata->successful());

            // $response = Http::acceptJson()->withHeaders([
            //     'Connection' => 'keep-alive',
            //     'Content-Type' => 'application/json',
            //     'Accept' => '*/*',
            // ])->withBody("'url':'".$urlfinal."'",'application/json' )->post('https://api-prod-pe.prod.clarodigital.net/api/PE_MS_FE_POSTS/createPost');

            // dd($response);
        }


        //dd($urlfinal);
        foreach($subcategorias as $sub){

            $categoria = Category::where('id',$sub)->first();

            if (array_key_exists($categoria->parent->id, $categorias)) {
                $pariente[]=$categoria->parent->id;
            }

        }

        //anexamos post a categoria huerfana
        if($pariente!=null){

            $huerfanos = array_diff($categorias,$pariente);



            foreach($huerfanos as $row){
                $hcat = Category::find($row);

                $urlfinalcat = $baseurl."/".$hcat->slug."/post/?=".Str::slug($request->titulo, '-');

                $getdata =  Http::asForm()->post('https://api-prod-pe.prod.clarodigital.net/api/PE_MS_FE_POSTS/createPost',
                [
                    'url' => $urlfinalcat,
                ]);

                Log::info($getdata->successful());

            }
        }




        return redirect(route('post.index'))
        ->with('info', 'Artículo actualizado con exito.');
    }


    public function edit($id)
    {
        $articulo = Post::find($id);
        $categories = Category::orderBy('id','desc')->get();
        $authors = Author::orderBy('nombre','asc')->get();
        $tags = Tag::orderBy('nombre','asc')->get();
        $cats=[];
        $itags=[];
        $iquiz=[];

       foreach($articulo->categories as $cat){
        $cats[] = $cat->id;
       }

       if(isset($articulo->tags)){
            foreach($articulo->tags as $tag){
                $itags[] = $tag->id;
            }
        }

         $quizes = Quiz::orderBy('titulo')->get();

        foreach($quizes as $quiz){
            $iquiz[] = $quiz->id;
        }

        return view('backend.publicaciones.edit',['iquiz'=>$iquiz,'quizes'=>$quizes,'itags'=>$itags,'cats'=>$cats,'articulo'=>$articulo,'categories'=>$categories,'authors'=>$authors,'tags'=>$tags]);
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
        $post->quiz_id = $request->quiz;
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
        $post = Post::find($request->id);

        Post::find($request->id)->delete();

        $baseurl= 'https://www.claro.com.pe/hablando-claro';

        if($post->parent->slug == null){
            //remitir post
            $urlfinal = $baseurl."/".$post->slug."/post/?=".Str::slug($post->titulo, '-');

            Post::find($request->id)->delete();


            $getdata = Http::asForm()->post('https://api-prod-pe.prod.clarodigital.net/api/PE_MS_FE_POSTS/eliminaPost',
                [
                    'url' => $urlfinal,
                ]);
                $rpta = $getdata->json();
                Log::info($getdata->successful());
        }else{

            $urlfinal = $baseurl."/".$post->parent->slug."/".$post->slug."/post/?=".Str::slug($post->titulo, '-');




            $getdata = Http::asForm()->post('https://api-prod-pe.prod.clarodigital.net/api/PE_MS_FE_POSTS/eliminaPost',
                [
                    'url' => $urlfinal,
                ]);
                $rpta = $getdata->json();
                Log::info($getdata->successful());
        }


        return redirect()->route('post.index')->with('info','Artículo eliminado con éxito');
    }
}
