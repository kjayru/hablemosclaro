<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function author(){
        return $this->belongsTo(Author::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function posttype(){
        return $this->belongsTo(PostType::class,'post_type_id');
    }

    public static function next($id,$category_id=0,$subcategory_id=0){

        $art = Post::find($id);


        $slug =null;
        $titulo = null;
        $ids=[];
        $category=null;
        $subcategory=null;
        $result=[];

        if(isset($subcategory_id)){
            $subcategory = Category::find($subcategory_id);


            $category = Category::find($category_id);

           $posts = $subcategory->posts;

           if(count($posts)){
                foreach($posts as $ps){
                        $ids[]=$ps->id;
                }

                $currentKey =  current(array_slice($ids, array_search($art->id, array_keys($ids)) + 2, 1));

                if(isset($currentKey)){
                    $post = Post::where('id',$currentKey)->first();
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

        }else{

            $category = Category::find($category_id);
            $posts = $category->posts;

            if(count($posts)){
                    foreach($posts as $ps){
                        $ids[]=$ps->id;
                    }

                    $currentKey =  current(array_slice($ids, array_search($art->id, array_keys($ids)) + 2, 1));

                    if(isset($currentKey)){
                        $post = Post::where('id',$currentKey)->first();
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
        }

        return $result;

    }
    public  static function previous($id,$category_id,$subcategory_id){

        $art = Post::find($id);

        $slug =null;
        $titulo = null;
        $ids=[];
        $category=null;
        $subcategory=null;
        $result=[];




        if(isset($subcategory_id)){
            $subcategory = Category::find($subcategory_id);
            $category = Category::find($category_id);

           $posts = $subcategory->posts;

           if(count($posts)){

                foreach($posts as $ps){
                        $ids[]=$ps->id;
                }

                $currentKey =  current(array_slice($ids, array_search($art->id, array_keys($ids)) + 0, 1));

                if(isset($currentKey)){
                    $post = Post::where('id',$currentKey)->first();
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


        }else{

           // dd($category);
           $category = Category::find($category_id);


           $posts = $category->posts;

           if(count($posts)){
                   foreach($posts as $ps){
                       $ids[]=$ps->id;
                   }

                   $currentKey =  current(array_slice($ids, array_search($art->id, array_keys($ids)) + 2, 1));

                   if(isset($currentKey)){
                       $post = Post::where('id',$currentKey)->first();
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

        }

        return $result;
    }



    public static function TimeEstimate($text){
        $words = strip_tags($text);
        $words = str_word_count($words);
        $minutes = round($words/200);
        if ($minutes <= 1) {
            $timetoread = "$minutes ";
        }
        else{
            $timetoread = "$minutes ";
        }
        return $timetoread;
    }


    public static function getCategory($id){
      //get categories post
        $subcat_id=null;
        $cat_id = null;
        $subcategory=null;
        $category=null;
        $post = Post::find($id);
        $categories = $post->categories;
     //get category

        foreach($categories as $cat){
            if(isset($cat->parent_id)){
                $subcat_id = $cat->id;
            }
        }
        if(!isset($subcat_id)){

            foreach($categories as $cat){
                if(!isset($cat->parent_id)){
                    $cat_id = $cat->id;
                }
            }

        }
        //dd($subcat_id);
        if(isset($subcat_id)){
            $subcategory = Category::where('id',$subcat_id)->first();
            $category = Category::where('id',$subcategory->parent_id)->first();
        }else{
            $category = Category::where('id',$cat_id)->first();
        }


        return array("category"=>$category,"subcategory"=>$subcategory);
    }

    public function quiz(){
        return $this->hasOne(Quiz::class,'id','quiz_id');
    }

}
