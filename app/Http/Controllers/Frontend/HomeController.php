<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.home');
    }

    public function categoria($categoria){

        $category = Category::where('slug',$categoria)->first();

        $categorias = null;
        $articulos = null;

        $contador = Category::where('parent_id',$category->id)->count();

        if($contador>0){
            $categorias = Category::where('parent_id',$category->id)->get();
        }else{
            $articulos = Post::where('category_id',$category->id)->get();
        }

        return view('frontend.category',['categorias'=>$categorias,'articulos'=>$articulos]);
    }

    public function subcategoria($categoria,$subcategoria){


        $category = Category::where('slug',$subcategoria)->first();

        $articulos = Post::where('category_id',$category->id)->get();

        return view('frontend.category',['articulos'=>$articulos]);
    }


    public function articulo($categoria,$subcategoria,$articulo){

        $post = Post::where('slug',$articulo)->first();

        return view('frontend.post',['articulo'=>$post]);

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
