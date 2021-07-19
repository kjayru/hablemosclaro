<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function authors(){
        return $this->belongsToMany(Author::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function posttype(){
        return $this->belongsTo(PostType::class);
    }

    public static function next($id){
        // get next user

        //get category
        $art = Post::find($id);

        $parent = $art->category->parent;
        $slug =null;
        $titulo = null;


        if(isset($parent)){
            $subcategory = $art->category->slug;
            $category = $art->category->parent->slug;
            $category_id = $art->category->id;

            $next_id =  Post::where('id', '>', $id)->where("category_id",$category_id)->min('id');

            if(isset($next_id)){
                $post = Post::where('id',$next_id)->first();
                if(isset($post)){
                    $slug = $post->slug;
                    $titulo = $post->titulo;
                }
            }

        }else{
            $category = $art->category->slug;
            $subcategory =null;
            $category_id = $art->category->id;
            $next_id =  Post::where('id', '>', $id)->where("category_id",$category_id)->min('id');

            if(isset($next_id)){
                $post = Post::where('id',$next_id)->first();

                if(isset($post)){
                    $slug = $post->slug;
                    $titulo = $post->titulo;
                }
            }
        }



        $result = [
            "category" => $category,
            "subcategory" => $subcategory,
            "slug" => $slug,
            "titulo" => $titulo,
        ];



        return $result;

    }
    public  static function previous($id){

        $art = Post::find($id);

        $parent = $art->category->parent;
        $slug =null;
        $titulo = null;

///select * from posts where id = (select min(id)  from posts where id > 203  and  posts.category_id=17) next

/// select * from posts where id = (select max(id) from posts where id < 203  and  posts.category_id=17 )   previu

        if(isset($parent)){
            $subcategory = $art->category->slug;
            $category = $art->category->parent->slug;
            $category_id = $art->category->id;

            $previous_id = Post::where('id', '<', $id)->where("category_id",$category_id)->max('id');

            if(isset($previous_id)){
                $post = Post::where('id',$previous_id)->first();
                if(isset($post)){
                    $slug = $post->slug;
                    $titulo = $post->titulo;
                }
            }

        }else{
            $category = $art->category->slug;
            $subcategory =null;
            $category_id = $art->category->id;

            $previous_id = Post::where('id', '<', $id)->where("category_id",$category_id)->max('id');
            if(isset($previous_id)){
                $post = Post::where('id',$previous_id)->first();
                if(isset($post)){
                    $slug = $post->slug;
                    $titulo = $post->titulo;
                }
            }
        }

        //$posts = Post::where("category_id",$category_id)->orderBy('id','desc')->get();
        //dd($posts);



        $result = [
            "category" => $category,
            "subcategory" => $subcategory,
            "slug" => $slug,
            "titulo" => $titulo,
        ];

        return $result;
    }

}
