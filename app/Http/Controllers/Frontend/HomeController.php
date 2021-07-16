<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Suscription;
use Illuminate\Support\Facades\URL;

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

            $articulos = Post::where('category_id',$category->id)->get();
            $catcount = Category::where('parent_id',$category->parent_id)->count();

            if($catcount>0){
                $categorias = Category::where('parent_id',$category->parent_id)->get();

            }

        }else{

            $post = Post::where('slug',$subcategoria)->first();

            $category_id = $post->category->id;

            $relacionados = Post::where('category_id',$category_id)->inRandomOrder()->take(5)->get();




            return view('frontend.post',['articulo'=>$post,'relacionados'=>$relacionados,'category'=>$category]);
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



        $post = Post::where('slug',$articulo)->first();


        $posts = Post::all();

       foreach($posts as $post){
           if(count($post->authors)>0){
               $columns[] = $post;
           }
       }


       $category_id = $post->category->id;

       $relacionados = Post::where('category_id',$category_id)->inRandomOrder()->take(5)->get();


       $videos = Post::where('post_type_id',3)->orderBy('id','asc')->take(4)->get();

        return view('frontend.post',['videos'=>$videos,'columns'=>$columns,'articulo'=>$post,'relacionados'=>$relacionados]);

    }



    public function suscribirse(Request $request){


        $news = new Suscription();
        $news->email = $request->email;
        $news->temas = serialize($request->interes);
        $news->save();

        return response()->json(['rpta'=>"ok"]);
    }

    public function buscar(Request $request){

        $posts = Post::where('titulo','LIKE',"%{$request->word}%")->get();
        return response()->json(['rpta'=>'ok',"data"=>$request]);
    }




}
