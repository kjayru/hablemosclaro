<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Suscription;
use App\Models\PostType;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articulos = Post::where('destacado',1)->where('post_type_id',1)->get();
        $categorias = Category::wherenull('parent_id')->get();
        $sliders = Post::where('post_type_id',4)->get();
        $posts = Post::all();

        foreach($posts as $post){
            if(count($post->authors)>0){
                $columns[] = $post;
            }
        }


        $videos = Post::where('post_type_id',3)->orderBy('id','asc')->take(4)->get();
        return view('frontend.home',['articulos'=>$articulos,'categorias'=>$categorias,'columns'=>$columns,'videos'=>$videos,'sliders'=>$sliders]);
    }

    public function categoria($categoria){

        $category = Category::where('slug',$categoria)->first();

        $categorias = null;
        $articulos = null;

        $contador = Category::where('parent_id',$category->id)->count();

        if($contador>0){
            $categorias = Category::where('parent_id',$category->id)->get();
           // $articulos = $category->posts;

            foreach($categorias as $cat){
                if(count($cat->posts)>0){

                    foreach($cat->posts as $art){
                        $post[] = $art;
                      }
                }
            }

            $articulos = collect($post);

        }else{
            $articulos = $category->posts;
        }

        $posts = Post::all();

        foreach($posts as $post){
            if(count($post->authors)>0){
                $columns[] = $post;
            }
        }

        $videos = Post::where('post_type_id',3)->orderBy('id','asc')->take(4)->get();

        return view('frontend.category',['videos'=>$videos,'columns'=>$columns,'categorias'=>$categorias,'articulos'=>$articulos,'categoria'=>$categoria,'category'=>$category]);
    }


    public function subcategoria($categoria,$subcategoria){
        $categorias = null;
        $category = Category::where('slug',$subcategoria)->first();

        if(!is_null($category)){

            $articulos = Post::where('category_id',$category->id)->orderBy('id', 'desc')->get();
            $catcount = Category::where('parent_id',$category->parent_id)->count();

            if($catcount>0){
                $categorias = Category::where('parent_id',$category->parent_id)->get();

            }

        }else{

            $post = Post::where('slug',$subcategoria)->first();

            $category_id = $post->category->id;



            $relacionados = Post::where('category_id',$category_id)->inRandomOrder()->take(5)->get();

            $next = Post::next($post->id);

            $previous = Post::previous($post->id);


            return view('frontend.post',['articulo'=>$post,'relacionados'=>$relacionados,'category'=>$category,'next'=>$next,'previous'=>$previous]);
        }

       $current_url = url()->full();

       $posts = Post::all();

       foreach($posts as $post){
           if(count($post->authors)>0){
               $columns[] = $post;
           }
       }

       $videos = Post::where('post_type_id',3)->orderBy('id','asc')->take(4)->get();

        return view('frontend.subcategory',['videos'=>$videos,'columns'=>$columns,'categorias'=>$categorias,'articulos'=>$articulos,"categoria"=>$categoria,"subcategoria"=>$subcategoria,'current_url'=>$current_url,'category'=>$category]);
    }


    public function articulo($categoria,$subcategoria,$articulo){

        //dd($categoria." ".$subcategoria);

        $articulo = Post::where('slug',$articulo)->first();

        $next = Post::next($articulo->id);
        $previous = Post::previous($articulo->id);
       // dd($post);

        $posts = Post::all();

       foreach($posts as $post){
           if(count($post->authors)>0){
               $columns[] = $post;
           }
       }


       $category_id = $post->category->id;

       $relacionados = Post::where('category_id',$category_id)->inRandomOrder()->take(5)->get();


       $videos = Post::where('post_type_id',3)->orderBy('id','asc')->take(4)->get();

        return view('frontend.post',['videos'=>$videos,'columns'=>$columns,'articulo'=>$articulo,'relacionados'=>$relacionados,'next'=>$next,'previous'=>$previous]);

    }



    public function suscribirse(Request $request){


        $news = new Suscription();
        $news->email = $request->email;
        $news->temas = serialize($request->interes);
        $news->save();

        return response()->json(['rpta'=>"ok"]);
    }

    public function buscar(Request $request){
        $posts = DB::table('posts')
                    ->where('posts.titulo','LIKE',"%{$request->word}%")
                    ->leftJoin('categories', 'posts.category_id', 'categories.id')
                    ->select('posts.titulo as titulo', 'posts.slug as slug', 'categories.slug as slugcategory')
                    ->limit(4)
                    ->get();
        return response()->json(['rpta'=>'ok',"data"=>$posts]);
    }

    public function posttype($posttype){


        $type = PostType::where('tipo',$posttype)->first();

        $articulos = Post::where('post_type_id',$type->id)->orderBy('id', 'desc')->get();



        $categorias = Category::wherenull('parent_id')->get();

        return view('frontend.articulos',['articulos'=>$articulos,'posttype'=>$type,"categorias"=>$categorias]);
    }



}
