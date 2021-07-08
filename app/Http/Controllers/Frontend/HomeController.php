<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
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

        $articulos = Post::where('destacado',1)->get();
        $categorias = Category::wherenull('parent_id')->get();

        $posts = Post::all();

       foreach($posts as $post){
           if(count($post->authors)>0){
              $columns[] = $post;
           }
       }

       $videos = Post::where('post_type_id',2)->orderBy('id','asc')->take(4)->get();


        return view('frontend.home',['articulos'=>$articulos,'categorias'=>$categorias,'columns'=>$columns,'videos'=>$videos]);
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



        return view('frontend.category',['categorias'=>$categorias,'articulos'=>$articulos,'categoria'=>$categoria]);
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
            return view('frontend.post',['articulo'=>$post]);
        }

       $current_url = url()->full();

        return view('frontend.subcategory',['categorias'=>$categorias,'articulos'=>$articulos,"categoria"=>$categoria,"subcategoria"=>$subcategoria,'current_url'=>$current_url]);
    }


    public function articulo($categoria,$subcategoria,$articulo){

        $post = Post::where('slug',$articulo)->first();

        return view('frontend.post',['post'=>$post]);

    }



    public function categories(){

        $categories = Category::where('parent_id',null)->get();
        foreach($categories as $cat){

            if(count($cat->parent)>0){
                echo $cat->parent."<br><br>";
            }
        }
       // dd($categories[0]->parent);
    }

}
