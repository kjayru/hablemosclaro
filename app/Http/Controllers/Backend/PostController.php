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
use App\Models\CategoryPost;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

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
        $categories = Category::whereNotNull("parent_id")->orderBy('id','desc')->get();
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


        $subcategorias=null;

          $validated = $request->validate([
            'titulo' => 'required',
            'contenido' => 'required',
            'imageBanner' => 'required',
            'imageCard' => 'required',

        ]);



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


        //$post->categories()->sync($request->category);

        $subcategoria = Category::where('id',$request->category)->first();
        $cat_id = $subcategoria->parent_id;


        $cpostparent = new CategoryPost();
        $cpostparent->category_id = $cat_id;
        $cpostparent->post_id = $post->id;
        $cpostparent->save();

        $cpostchild = new CategoryPost();
        $cpostchild->category_id = $request->category;
        $cpostchild->post_id = $post->id;
        $cpostchild->save();


        $post->tags()->sync($request->tags);

        ////registro en postgress

        $articulos= [
            "title" => $post->titulo,
            "slug" => $post->slug,
            "banner" => '/storage/'.$post->banner,
            "card" => '/storage/'.$post->imagenbox,
            "movil" => '/storage/'.$post->movil,
            "tablet" => '/storage/'.$post->tablet,
            "standout" => $post->destacado,
            "state"=>$post->estado,
            "publish_date" => $post->date_publish,
            'category_id' => $request->category,
            'template_id'=>1,
            'post_type_id'=> $post->post_type_id,
            'author_id' => $post->author_id,
            'meta_description' => $post->meta_description,
            'meta_title' => $post->meta_titulo,
            'meta_image'=>'/storage/'.$post->meta_image,
            'meta_keyword' =>$post->meta_keywords,
            'twitter_site' => $post->twitter_site,
            'twitter_create' => $post->twitter_create,
            "created_at" => $post->created_at
        ];




        $idpost =  DB::connection("pgsql")->table("posts")->insertGetId($articulos);

        $contenido = [
                "content_text"=>$post->contenido,
                "post_id" => $idpost
        ];

        DB::connection("pgsql")->table("contents")->insert($contenido);

        if(isset($request->tags)){

            foreach($request->tags as $row){


                DB::connection("pgsql")->table("post_tag")->insert(['post_id'=>$idpost, 'tag_id'=>$row ]);
            }
        }




        $pariente=null;
        $baseurl= 'https://www.claro.com.pe/hablando-claro';

            if(Category::where('id',$request->category)->whereNotNull('parent_id')->first()){
                $subcategorias[]=$request->category;
            }

        if($subcategorias!=null){
            foreach($subcategorias as $sub){
                $scat =  Category::where('id',$sub)->first();

            //remitir post
                if(empty($scat->parent)){
                    $urlfinal = $baseurl."/".$scat->slug."/post/?=".Str::slug($request->titulo, '-');
                }else{
                    $urlfinal = $baseurl."/".$scat->parent->slug."/".$scat->slug."/post/?=".Str::slug($request->titulo, '-');
                }

                $getdata = Http::withHeaders(['Content-Type' => 'application/json'])->post('https://api-prod-pe.prod.clarodigital.net/api/PE_MS_FE_POSTS/createPost',
                    [
                        'url' => $urlfinal,
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
        $categories = Category::whereNotNull("parent_id")->orderBy('id','desc')->get();
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
       // $post->categories()->sync($request->category);

        CategoryPost::where('post_id',$id)->delete();

       $subcategoria = Category::where('id',$request->category)->first();
        $cat_id = $subcategoria->parent_id;


        $cpostparent = new CategoryPost();
        $cpostparent->category_id = $cat_id;
        $cpostparent->post_id = $post->id;
        $cpostparent->save();

        $cpostchild = new CategoryPost();
        $cpostchild->category_id = $request->category;
        $cpostchild->post_id = $post->id;
        $cpostchild->save();

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



        $baseurl= 'https://www.claro.com.pe/hablando-claro';

        if(!isset($post->parent->slug)){
            //remitir post
            $urlfinal = $baseurl."/".$post->slug."/post/?=".Str::slug($post->titulo, '-');




            $getdata = Http::withHeaders(['Content-Type' => 'application/json'])->post('https://api-prod-pe.prod.clarodigital.net/api/PE_MS_FE_POSTS/eliminaPost',
                [
                    'url' => $urlfinal,
                ]);
                $rpta = $getdata->json();
                Log::info($getdata->successful());
        }else{

            $urlfinal = $baseurl."/".$post->parent->slug."/".$post->slug."/post/?=".Str::slug($post->titulo, '-');




            $getdata = Http::withHeaders(['Content-Type' => 'application/json'])->post('https://api-prod-pe.prod.clarodigital.net/api/PE_MS_FE_POSTS/eliminaPost',
                [
                    'url' => $urlfinal,
                ]);
                $rpta = $getdata->json();
                Log::info($getdata->successful());
        }

        Post::find($request->id)->delete();

        return redirect()->route('post.index')->with('info','Artículo eliminado con éxito');
    }

    public function publish(Request $request){
        $subcategorias=null;
        $baseurl= 'https://www.claro.com.pe/hablando-claro';
        $articulo = Post::find($request->id);
        foreach($articulo->categories as $cat){
            $subcategorias[] = $cat->id;
        }

        $urls = "";

        if($subcategorias!=null){

            foreach($subcategorias as $sub){
                $scat =  Category::where('id',$sub)->first();

            //remitir post
                if(empty($scat->parent)){
                    $urlfinal = $baseurl."/".$scat->slug."/post/?=".$articulo->slug;
                }else{
                    $urlfinal = $baseurl."/".$scat->parent->slug."/".$scat->slug."/post/?=".$articulo->slug;
                }
                $urls .= $urlfinal." | ";

                $getdata = Http::withHeaders(['Content-Type' => 'application/json'])->post('https://api-prod-pe.prod.clarodigital.net/api/PE_MS_FE_POSTS/createPost',
                    [
                        'url' => $urlfinal,
                    ]);


                    Log::info($getdata->successful());
            }


        }
        return redirect()->route('post.index')->with('info', "se está publcando las rutas --".$urls);
    }

}
