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
use App\Models\Visit;

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

        $ultimos = Post::where('estado',1)->where('post_type_id',1)->orderBy('date_publish','desc')->take(4)->get();
        $categorias = Category::wherenull('parent_id')->get();
        $sliders = Post::where('post_type_id',4)->orderBy('date_publish','desc')->take(5)->get();
        $columns = Post::where('estado',1)->whereNotNull('author_id')->orderBy('date_publish','desc')->take(4)->get();

       /* foreach($posts as $post){
            if(count($post->author_id)>0){
                $columns[] = $post;
            }
        }*/


        $videos = Post::where('post_type_id',2)->where('estado',1)->orderBy('date_publish','desc')->take(4)->get();
        return view('frontend.home',['ultimos'=>$ultimos,'articulos'=>$articulos,'categorias'=>$categorias,'columns'=>$columns,'videos'=>$videos,'sliders'=>$sliders]);
    }

    public function categoria($categoria){

        $category = Category::where('slug',$categoria)->first();

        $categorias = null;
        $articulos = null;
        $subcategoria = null;

        $contador = Category::where('parent_id',$category->id)->count();

        if($contador>0){
            $categorias = Category::where('parent_id',$category->id)->get();

            //$singlecat = Category::where('id',$category->id)->get();

            foreach($categorias as $cat){


                    if(count($cat->posts)>0){

                        foreach($cat->posts as $art){
                            if($art->estado ==1){



                                $post_ids[] = $art->id;
                                 /*array(

                                   "id" => $art->id,
                                    "titulo" => $art->titulo,
                                    "card" => $art->imagenbox,
                                    "slug" => $art->slug,
                                    "categoria" => @$category,
                                    "subcategoria" => @$art->categories[0]->parent,
                                    'date_publish'=> @$art->date_publish,
                                    'lectura' => @Post::TimeEstimate($art->contenido)

                                );*/
                            }
                        }
                    }

            }

            foreach( $category->posts as $sin){
                if($sin->estado ==1){

                    $post_ids[] = $sin->id;
                    /*  array(

                       "id" => $sin->id,
                        "titulo" => $sin->titulo,
                        "card" => $sin->imagenbox,
                        "slug" => $sin->slug,
                        "categoria" => @$category,
                        "subcategoria" => @$sin->categories[0]->parent,
                        'date_publish'=> @$sin->date_publish,
                        'lectura' => @Post::TimeEstimate($sin->contenido)

                    );*/
                }
            }

           // dd($post_ids);
            $llaves = array_unique($post_ids);

            foreach($llaves as $k){

                $p = Post::where('id',$k)->orderBy('date_publish','desc')->first();

                foreach($p->categories as $c){
                    if(isset($c->parent)){
                        dd($c->parent);
                        if($c->parent->parent_id == $category->id){
                            $subcat = $c->parent;
                        }
                    }
                }

                $post[] = array(

                    "id" => $p->id,
                     "titulo" => $p->titulo,
                     "card" => $p->imagenbox,
                     "slug" => $p->slug,
                     "categoria" => @$category,
                     "subcategoria" => @$subcat,
                     'date_publish'=> @$p->date_publish,
                     'lectura' => @Post::TimeEstimate($p->contenido)

                 );
            }
            $articulos = collect($post);


        }else{
            $categorias = $category->posts;



            foreach($categorias as $art){


                        if($art->estado ==1){



                            $articulos[] = array(
                                "id" => $art->id,
                                "titulo" => $art->titulo,
                                "card" => $art->imagenbox,
                                "slug" => $art->slug,
                                "categoria" => @$category,
                                "subcategoria" => '',
                                'date_publish'=> @$art->date_publish,
                                'lectura' => @Post::TimeEstimate($art->contenido)

                            );
                        }


            }



        }

        $columns = Post::where('estado',1)->whereNotNull('author_id')->orderBy('date_publish','desc')->take(4)->get();


        $videos = Post::where('post_type_id',2)->where('estado',1)->orderBy('date_publish','desc')->take(4)->get();

        return view('frontend.category',['videos'=>$videos,'columns'=>$columns,'categorias'=>$categorias,'articulos'=>$articulos,'categoria'=>$categoria,'category'=>$category,'subcategoria'=>$subcategoria]);
    }


    public function subcategoria($categoria,$subcategoria){
        $categorias = null;

        $category = Category::where('slug',$subcategoria)->first();

        $articulos = [];
        $subcategory_id = null;

        if(!is_null($category)){
            $menu = Category::where('parent_id',$category->parent_id)->get();
            $posts = $category->posts;
            $catcount = count($category->posts);

            if($catcount>0){
                $categorias = Category::where('parent_id',$category->parent_id)->get();


            }
            foreach($posts as $post){
                if($post->estado==1){
                    $articulos[] = array(
                        "id"=>$post->id,
                        "titulo"=>$post->titulo,
                        "card" => $post->imagenbox,
                        "slug" => $post->slug,
                        "categoria" => $categoria,
                        "subcategoria" => $subcategoria,
                        'date_publish'=>$post->date_publish,
                        'lectura' => @Post::TimeEstimate($post->contenido)
                    );
                }
            }


        }else{

            $post = Post::where('slug',$subcategoria)->first();
            $category = Category::where('slug',$categoria)->first();
            $category_id = $category->id;

            $relacionados = Post::where('category_id',$category_id)->inRandomOrder()->take(5)->get();
            $next = Post::next($post->id,$category_id,$subcategory_id);
            $previous = Post::previous($post->id,$category_id,$subcategory_id);


            //contador de visitas
            $remote_ip  = $_SERVER['REMOTE_ADDR'];
            $post_id = $post->id;

            $contador = Visit::where('ip',$remote_ip)->where('post_id',$post_id)->count();
            $indice = 1;
            if($contador==0){
                    $visita = new Visit();
                    $visita->ip = $remote_ip;
                    $visita->post_id = $post_id;
                    $visita->save();

                    $postvisited = Post::find($post_id);

                    $pv = $postvisited->visited;

                    $postvisited->visited = intval($pv) + 1;
                    $postvisited->save();
            }


            return view('frontend.post',['categoria'=>$category,'articulo'=>$post,'relacionados'=>$relacionados,'category'=>$category,'next'=>$next,'previous'=>$previous,'subcategoria'=>null]);
        }

       $current_url = url()->full();

        /**Columnas */
        $columns = Post::where('estado',1)->whereNotNull('author_id')->orderBy('date_publish','desc')->take(4)->get();



        $videos = Post::where('post_type_id',2)->where('estado',1)->orderBy('date_publish','desc')->take(4)->get();

       $categor = Category::where('slug',$categoria)->first();
       $subcategor = Category::where('slug',$subcategoria)->first();

       $max = Post::orderBy('visited','desc')->first();
       $postmax = array(
        "id"=>$max->id,
        "titulo"=>$max->titulo,
        "card" => $max->imagenbox,
        "slug" => $max->slug,
        "categoria" => @$category,
        "subcategoria" => null,
        'date_publish'=>$max->date_publish,
        'lectura' => @Post::TimeEstimate($max->contenido)
    );

        return view('frontend.subcategory',['menu'=>$menu,'postmax'=>$postmax,'videos'=>$videos,'columns'=>$columns,'categorias'=>$categorias,'articulos'=>$articulos,"categoria"=>$categor,"subcategoria"=>$subcategor,'current_url'=>$current_url,'category'=>$category]);
    }


    public function articulo($categoria,$subcategoria,$articulo){

        $category = Category::where("slug",$categoria)->first();
        $subcategory = Category::where("slug",$subcategoria)->first();
        $articulo = Post::where('slug',$articulo)->first();

        $next = Post::next($articulo->id,$category->id,$subcategory->id);
        $previous = Post::previous($articulo->id,$category->id,$subcategory->id);
       // dd($post);

       $columns = Post::where('estado',1)->whereNotNull('author_id')->orderBy('date_publish','desc')->take(4)->get();


       $category_id = $category->id;

       $relacionados = Post::where('category_id',$category_id)->inRandomOrder()->take(5)->get();


       $videos = Post::where('post_type_id',2)->where('estado',1)->orderBy('date_publish','desc')->take(4)->get();

       //contador de visitas
       $remote_ip  = $_SERVER['REMOTE_ADDR'];
       $post_id = $articulo->id;

       $contador = Visit::where('ip',$remote_ip)->where('post_id',$post_id)->count();
       $indice = 1;
       if($contador==0){
            $visita = new Visit();
            $visita->ip = $remote_ip;
            $visita->post_id = $post_id;
            $visita->save();

            $postvisited = Post::find($post_id);

            $pv = $postvisited->visited;

            $postvisited->visited = intval($pv) + 1;
            $postvisited->save();
       }


       $max = Post::orderBy('visited','desc')->first();


       $postmax = array(
        "id"=>$max->id,
        "titulo"=>$max->titulo,
        "card" => $max->imagenbox,
        "slug" => $max->slug,
        "categoria" => @$category,
        "subcategoria" => @$subcategory,
        'date_publish'=>$max->date_publish,
        'lectura' => @Post::TimeEstimate($max->contenido)
       );

        return view('frontend.post',['postmax'=>$postmax,'categoria'=>$category,'subcategoria'=>$subcategory,'videos'=>$videos,'columns'=>$columns,'articulo'=>$articulo,'relacionados'=>$relacionados,'next'=>$next,'previous'=>$previous]);

    }



    public function suscribirse(Request $request){

        $news = new Suscription();
        $news->email = $request->email;
        $news->temas = serialize($request->interes);
        $news->save();

        return response()->json(['rpta'=>"ok"]);
    }


    public function buscar(Request $request){
        /*$posts = DB::table('posts')
                    ->where('posts.titulo','LIKE',"%{$request->word}%")
                    ->leftJoin('categories', 'posts.category_id', 'categories.id')
                    ->select('posts.titulo as titulo', 'posts.slug as slug', 'categories.slug as slugcategory')
                    ->limit(4)
                    ->get();*/

        $result = [];
         $posts = Post::where('posts.titulo','LIKE',"%{$request->word}%")->take(6)->get();

         foreach($posts as $post){
             if(isset($post->categories[0]->parent)){
                 $result[] = array(
                     "category"=>@$post->categories[0]->parent->slug,
                     "subcategory"=>@$post->categories[0]->slug,
                     "slug" => $post->slug,
                     "titulo" => $post->titulo,
                    );
             }else{
                $result[] = array(
                    "category"=>@$post->categories[0]->slug,
                    "subcategory"=>"",
                    "slug" => $post->slug,
                    "titulo" => $post->titulo,
                   );
             }
         }

         //dd($result);

        return response()->json(['rpta'=>'ok',"data"=>$result]);
    }



    public function posttype($posttype){

        $type = PostType::where('tipo',$posttype)->first();
        $articulos = Post::where('post_type_id',$type->id)->orderBy('id', 'desc')->get();
        $categorias = Category::wherenull('parent_id')->get();

        return view('frontend.articulos',['articulos'=>$articulos,'posttype'=>$type,"categorias"=>$categorias]);
    }


    public function resultados($word){


        $result = [];
        $articulos = Post::where('posts.titulo','LIKE',"%{$word}%")->get();

        foreach($articulos as $post){
            if(isset($post->categories[0]->parent)){
                $result[] = array(
                    "category"=>@$post->categories[0]->parent->slug,
                    "subcategory"=>@$post->categories[0]->slug,
                    "slug" => $post->slug,
                    "titulo" => $post->titulo,
                    "banner" => $post->banner,
                    "imagen" => $post->imagenbox,
                    );
            }else{
               $result[] = array(
                   "category"=>@$post->categories[0]->slug,
                   "subcategory"=>"",
                   "slug" => $post->slug,
                   "titulo" => $post->titulo,
                   "imagenbox" => $post->imagenbox,
                  );
            }
        }

        $posts = collect($result);

        return view('frontend.buscar',['posts'=>$posts,'word'=>$word]);
    }

}
