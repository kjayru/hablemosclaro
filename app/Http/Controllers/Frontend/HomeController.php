<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Suscription;
use App\Models\PostType;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use App\Models\Visit;
use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Author;
use App\Models\PostTag;

use App\Models\ResultQuiz;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $new_url = "https://www.claro.com.pe/hablando-claro/";

        return redirect($new_url);

        $categorias = Category::wherenull('parent_id')->get();
        $articulos = Post::where('destacado',1)->where('post_type_id',1)->get();

        //ultimos
        $ults = Post::where('estado',1)->where('post_type_id',1)->orderBy('date_publish','desc')->take(4)->get();
        foreach($ults as $key=> $col){
           // dd($col);
            $ultimo[] = array(
                "id" => $col->id,
                "titulo" => $col->titulo,
                "card" => $col->imagenbox,
                "slug" => $col->slug,
                "categoria" =>  @Post::getCategory($col->id)['category'],
                "subcategoria" => @Post::getCategory($col->id)['subcategory'],
                //'date_publish'=> @Carbon::parse($col->date_publish)->locale('es')->isoFormat(' MMM d Y'),
                'date_publish' => @strftime("%d %h %Y", date (strtotime($col->date_publish )) ),
                'lectura' => @Post::TimeEstimate($col->contenido)

                );
            }
        $ultimos = collect($ultimo);


        //videos
       // $vids = Post::where('post_type_id',3)->where('estado',1)->orderBy('date_publish','desc')->take(4)->get();
       //videos
       $vids = Post::where('post_type_id',2)->where('estado',1)->orderBy('date_publish','desc')->take(4)->get();

       foreach($vids as $key => $col){
           $video[] = array(
               "id" => $col->id,
               "titulo" => $col->titulo,
               "card" => $col->imagenbox,
               "slug" => $col->slug,
               "video" => $col->video,
               "categoria" =>  @Post::getCategory($col->id)['category'],
               "subcategoria" => @Post::getCategory($col->id)['subcategory'],
               'date_publish'=>  @strftime("%d %h %Y", date (strtotime($col->date_publish )) ),
               'lectura' => @Post::TimeEstimate($col->contenido)

               );
           }
       $videos = collect($video);




        //sliders
        $slids = Post::where('post_type_id',4)->orderBy('date_publish','desc')->take(5)->get();
        foreach($slids as $key=> $col){
            $slider[] = array(
                "id" => $col->id,
                "titulo" => $col->titulo,
                "banner" => $col->banner,
                "movil" => $col->movil,
                "tablet" => $col->tablet,
                "slug" => $col->slug,
                "categoria" =>  @Post::getCategory($col->id)['category'],
                "subcategoria" => @Post::getCategory($col->id)['subcategory'],
                'date_publish'=> @strftime("%d %h %Y", date (strtotime($col->date_publish )) ),
                'lectura' => @Post::TimeEstimate($col->contenido)

            );
        }
     $sliders = collect($slider);

        //columnas
        $cols = Post::where('estado',1)->whereNotNull('author_id')->orderBy('date_publish','desc')->take(4)->get();
        foreach($cols as $key=> $col){

                $colum[] = array(
                    "id" => $col->id,
                    "titulo" => $col->titulo,
                    "card" => $col->imagenbox,
                    "slug" => $col->slug,
                    "categoria" =>  @Post::getCategory($col->id)['category'],
                    "subcategoria" => @Post::getCategory($col->id)['subcategory'],
                    'date_publish'=> @strftime("%d %h %Y", date (strtotime($col->date_publish )) ),
                    'lectura' => @Post::TimeEstimate($col->contenido),
                    'foto' => @$col->author->imagen,
                    'nombre' => @$col->author->nombre,
                    'cargo'=>$col->author->cargo
                );
         }
         $columns = collect($colum);

        return view('frontend.home',[

            'ultimos'=>$ultimos,
            'articulos'=>$articulos,
            'categorias'=>$categorias,
            'columns'=>$columns,
            'videos'=>$videos,
            'sliders'=>$sliders]);
    }

    public function categoria($categoria){

       // dd("aqui");


        $category = Category::where('slug',$categoria)->first();
        if(!isset($category)){
             return abort(404);
        }

        $categorias = null;
        $articulos = null;
        $subcategoria = null;




        $new_url = "https://www.claro.com.pe/hablando-claro/".$category->slug;

        return redirect($new_url);



        $contador = Category::where('parent_id',$category->id)->count();

        if($contador>0){
            $categorias = Category::where('parent_id',$category->id)->get();

            foreach($categorias as $cat){

                    if(count($cat->posts)>0){

                        foreach($cat->posts as $art){
                            if($art->estado ==1){

                                $post_ids[] = $art->id;

                            }
                        }
                    }
            }

            foreach( $category->posts as $sin){
                if($sin->estado ==1){
                    $post_ids[] = $sin->id;
                }
            }

           // dd($post_ids);
            $llaves = array_unique($post_ids);
            foreach($llaves as $k){
                $p = Post::where('id',$k)->orderBy('date_publish','desc')->first();
                foreach($p->categories as $c){
                    if(isset($c->parent_id)){
                        if($c->parent_id == $category->id){
                            $subcat = $c;
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
                    // 'date_publish'=>  @Carbon::parse($p->date_publish)->locale('es')->isoFormat('d MMM Y'),
                     'date_publish' =>  @strftime("%d %b %Y", date (strtotime($p->date_publish )) ),
                     'lectura' => @Post::TimeEstimate($p->contenido)
                 );
            }

            $articulos = collect($post);

              $new_url = "https://www.claro.com.pe/hablando-claro/".$category->slug."/".$subcat->slug."/".$p->slug;

             return redirect($new_url);


        }else{
            $categorias = $category->posts;

            foreach($categorias->sortByDesc('date_publish') as $art){
                        if($art->estado ==1){

                            $articulos[] = array(
                                "id" => $art->id,
                                "titulo" => $art->titulo,
                                "card" => $art->imagenbox,
                                "slug" => $art->slug,
                                "categoria" => @$category,
                                "subcategoria" => '',
                                //'date_publish'=> @Carbon::parse($art->date_publish)->locale('es')->isoFormat('d MMM Y'),
                                'date_publish' =>  @strftime("%d %b %Y", date (strtotime($art->date_publish )) ),
                                'lectura' => @Post::TimeEstimate($art->contenido)

                            );
                        }


            }

            if($category->parent_id > 0){

                $new_url = "https://www.claro.com.pe/hablando-claro/".$category->parent->slug."/".$category->slug;
                return redirect($new_url);


            }else{

                $new_url = "https://www.claro.com.pe/hablando-claro/".$category->slug;
                return redirect($new_url);

            }



        }

        $cols = Post::where('estado',1)->whereNotNull('author_id')->orderBy('date_publish','desc')->take(4)->get();

        //column
        foreach($cols as $key=> $col){



                $colum[] = array(
                    "id" => $col->id,
                    "titulo" => $col->titulo,
                    "card" => $col->imagenbox,
                    "slug" => $col->slug,
                    "categoria" =>  @Post::getCategory($col->id)['category'],
                    "subcategoria" => @Post::getCategory($col->id)['subcategory'],
                    //'date_publish'=> @Carbon::parse($col->date_publish)->locale('es')->isoFormat('d MMM Y'),
                    'date_publish' =>  @strftime("%d %b %Y", date (strtotime($col->date_publish )) ),
                    'lectura' => @Post::TimeEstimate($col->contenido),
                    'foto' => @$col->author->imagen,
                    'nombre' => @$col->author->nombre,
                    'cargo'=>$col->author->cargo
                );


         }
        $columns = collect($colum);



        //videos
        $vids = Post::where('post_type_id',2)->where('estado',1)->orderBy('date_publish','desc')->take(4)->get();

        foreach($vids as $key => $col){
            $video[] = array(
                "id" => $col->id,
                "titulo" => $col->titulo,
                "card" => $col->imagenbox,
                "slug" => $col->slug,
                "video" => $col->video,
                "categoria" =>  @Post::getCategory($col->id)['category'],
                "subcategoria" => @Post::getCategory($col->id)['subcategory'],
                //'date_publish'=> @Carbon::parse($col->date_publish)->locale('es')->isoFormat('d MMM Y'),
                'date_publish' =>  @strftime("%d %b %Y", date (strtotime($col->date_publish )) ),
                'lectura' => @Post::TimeEstimate($col->contenido)

                );
            }
        $videos = collect($video);


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
            foreach($posts->sortByDesc('date_publish') as $post){
                if($post->estado==1){
                    $articulos[] = array(
                        "id"=>$post->id,
                        "titulo"=>$post->titulo,
                        "card" => $post->imagenbox,
                        "slug" => $post->slug,
                        "categoria" => $categoria,
                        "subcategoria" => $subcategoria,
                        //'date_publish'=> @Carbon::parse($post->date_publish)->locale('es')->isoFormat('d MMM Y'),
                        //'date_publish'=> @Carbon::parse($col->date_publish)->locale('es')->isoFormat('d MMM Y'),
                        //'date_publish'=> $post->date_publish,
                        'date_publish' => @strftime("%d %b %Y", date (strtotime($post->date_publish )) ),
                        'lectura' => @Post::TimeEstimate($post->contenido)
                    );
                }
            }

            $new_url = "https://www.claro.com.pe/hablando-claro/".$category->parent->slug."/".$category->slug;
            return redirect($new_url);

        }else{

            //
            if(Category::where('slug',$subcategoria)->count()==0){


                if(Post::where('slug',$subcategoria)->count()>0){


                    $articulo =  Post::where('slug',$subcategoria)->first();



                    $category = Category::where('slug',$categoria)->first();

                    $articulo_categoria=null;
                    foreach($articulo->categories as $cat){

                        if($cat->parent_id==0){
                            $articulo_categoria = $cat->slug;
                        }

                    }

                    $new_url = "https://www.claro.com.pe/hablando-claro/".$articulo_categoria."/post/?=".@$articulo->slug;

                   // dd($new_url);
                    return redirect($new_url);
                }
            }else{


                $category = Category::where('slug',$categoria)->first();


                if(isset($category->parent_id )){


                    $new_url = "https://www.claro.com.pe/hablando-claro/".$category->parent->slug."/".$category->slug;
                    return redirect($new_url);
                }else{
                    $new_url = "https://www.claro.com.pe/hablando-claro/".$category->slug;
                    return redirect($new_url);
                }
            }



            $relacionados=[];

            $post = Post::where('slug',$subcategoria)->first();

            $post->publicado = @Carbon::parse($post->date_publish)->locale('es')->isoFormat('D \\d\e MMMM\\,\\ YYYY');
            $post->tiempoLectura = @Post::TimeEstimate($post->contenido);

            $category = Category::where('slug',$categoria)->first();
            $category_id = $category->id;


            foreach($post->categories as $rela){
                if($rela->slug == $category->slug){
                    // dd($rel->posts);
                     $i = 1;
                        foreach($rela->posts as $k => $rel){
                            if($rel->id != $post->id && $rel->estado == 1){
                                if($i<5){
                                        $relacionados[] = array(
                                            "id"=>$rel->id,
                                            "titulo"=>$rel->titulo,
                                            "imagenbox" => $rel->imagenbox,
                                            "slug" => $rel->slug,
                                            "categoria" => @$category,
                                            "subcategoria" => null,
                                            //'date_publish'=> @Carbon::parse($rel->date_publish)->locale('es')->isoFormat('d MMM Y'),
                                            'date_publish' =>  @strftime("%d %b %Y", date (strtotime($rel->date_publish )) ),
                                            'lectura' => @Post::TimeEstimate($rel->contenido)
                                        );
                                }
                            }
                            $i++;
                        }

                }
            }



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

            $max = Post::orderBy('visited','desc')->where('estado',1)->first();
            $postmax = array(
                "id"=>$max->id,
                "titulo"=>$max->titulo,
                "card" => $max->imagenbox,
                "slug" => $max->slug,
                "categoria" => @$category,
                "subcategoria" => null,
                //'date_publish'=>@Carbon::parse($max->date_publish)->locale('es')->isoFormat('d MMM Y'),
                'date_publish' =>  @strftime("%d %b %Y", date (strtotime($max->date_publish )) ),
                'lectura' => @Post::TimeEstimate($max->contenido)
            );

            return view('frontend.post',['postmax'=>$postmax,'categoria'=>$category,'articulo'=>$post,'relacionados'=>$relacionados,'category'=>$category,'next'=>$next,'previous'=>$previous,'subcategoria'=>null]);

        }

       $current_url = url()->full();

        /**Columnas */
        $cols = Post::where('estado',1)->whereNotNull('author_id')->orderBy('date_publish','desc')->take(4)->get();

        //column
        foreach($cols as $key=> $col){

                $colum[] = array(
                    "id" => $col->id,
                    "titulo" => $col->titulo,
                    "card" => $col->imagenbox,
                    "slug" => $col->slug,
                    "categoria" => @$category,
                    "categoria" =>  @Post::getCategory($col->id)['category'],
                    "subcategoria" => @Post::getCategory($col->id)['subcategory'],
                    //'date_publish'=> @Carbon::parse($col->date_publish)->locale('es')->isoFormat('d MMM Y'),
                    'date_publish' => @strftime("%d %b %Y", date (strtotime($col->date_publish )) ),
                    'lectura' => @Post::TimeEstimate($col->contenido),
                    'foto' => @$col->author->imagen,
                    'nombre' => @$col->author->nombre,
                    'cargo'=>$col->author->cargo
                );
        }
        $columns = collect($colum);




        //$videos = Post::where('post_type_id',2)->where('estado',1)->orderBy('date_publish','desc')->take(4)->get();
        //videos
        $vids = Post::where('post_type_id',2)->where('estado',1)->orderBy('date_publish','desc')->take(4)->get();

        foreach($vids as $key => $col){
            $video[] = array(
                "id" => $col->id,
                "titulo" => $col->titulo,
                "card" => $col->imagenbox,
                "slug" => $col->slug,
                "video" => $col->video,
                "categoria" =>  @Post::getCategory($col->id)['category'],
                "subcategoria" => @Post::getCategory($col->id)['subcategory'],
                'date_publish'=> @strftime("%d %b %Y", date (strtotime($col->date_publish )) ),
                'lectura' => @Post::TimeEstimate($col->contenido)

                );
            }
        $videos = collect($video);


       $categor = Category::where('slug',$categoria)->first();
       $subcategor = Category::where('slug',$subcategoria)->first();

       $max = Post::orderBy('visited','desc')->where('estado',1)->first();
       $postmax = array(
            "id"=>$max->id,
            "titulo"=>$max->titulo,
            "card" => $max->imagenbox,
            "slug" => $max->slug,
            "categoria" => @$category,
            "subcategoria" => null,
            'date_publish'=>  @strftime("%d %b %Y", date (strtotime($max->date_publish )) ),
            'lectura' => @Post::TimeEstimate($max->contenido)
        );

        return view('frontend.subcategory',['menu'=>$menu,'postmax'=>$postmax,'videos'=>$videos,'columns'=>$columns,'categorias'=>$categorias,'articulos'=>$articulos,"categoria"=>$categor,"subcategoria"=>$subcategor,'current_url'=>$current_url,'category'=>$category]);
    }

    public function articulo($categoria,$subcategoria,$articulo){
        $relacionados=[];
        $category = Category::where("slug",$categoria)->first();
        $subcategory = Category::where("slug",$subcategoria)->first();
        $articulo = Post::where('slug',$articulo)->first();


        $next = Post::next($articulo->id,$category->id,$subcategory->id);
        $previous = Post::previous($articulo->id,$category->id,$subcategory->id);
       // dd($post);


       $new_url = "https://www.claro.com.pe/hablando-claro/".$subcategory->parent->slug."/".$subcategory->slug."/post/?=".$articulo->slug;

       return redirect($new_url);


       $columns = Post::where('estado',1)->whereNotNull('author_id')->orderBy('date_publish','desc')->take(4)->get();


       $category_id = $category->id;


       foreach($articulo->categories as $rela){
           if($rela->slug == $subcategory->slug){
              // dd($rel->posts);
             $i = 1;
               foreach($rela->posts as $k => $rel ){

                   if($rel->id != $articulo->id && $rel->estado == 1){

                    if($i<5){


                            $relacionados[] = array(
                                "id"=>$rel->id,
                                "titulo"=>$rel->titulo,
                                "imagenbox" => $rel->imagenbox,
                                "slug" => $rel->slug,
                                "categoria" => @$category,
                                "subcategoria" => null,
                                //'date_publish'=> @Carbon::parse($rel->date_publish)->locale('es')->isoFormat('d MMM Y'),
                                'date_publish' =>  @strftime("%d %b %Y", date (strtotime($rel->date_publish )) ),
                                'lectura' => @Post::TimeEstimate($rel->contenido)
                            );


                    }
                    $i++;
                  }
                }


           }
       }

      // $relacion = Post::where('category_id',$category_id)->where('id','<>',$articulo->id)->where('estado',1)->inRandomOrder()->take(4)->get();



       //relacionados arreglo



       //$videos = Post::where('post_type_id',2)->where('estado',1)->orderBy('date_publish','desc')->take(4)->get();
       //videos
       $vids = Post::where('post_type_id',2)->where('estado',1)->orderBy('date_publish','desc')->take(4)->get();

       foreach($vids as $key => $col){
           $video[] = array(
               "id" => $col->id,
               "titulo" => $col->titulo,
               "card" => $col->imagenbox,
               "slug" => $col->slug,
               "video" => $col->video,
               "categoria" =>  @Post::getCategory($col->id)['category'],
               "subcategoria" => @Post::getCategory($col->id)['subcategory'],
              // 'date_publish'=> @Carbon::parse($col->date_publish)->locale('es')->isoFormat('d MMM Y'),
               'date_publish' =>  @strftime("%d %b %Y", date (strtotime($col->date_publish )) ),
               'lectura' => @Post::TimeEstimate($col->contenido)

               );
           }
       $videos = collect($video);

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


       $max = Post::orderBy('visited','desc')->where('estado',1)->first();


       $postmax = array(
        "id"=>$max->id,
        "titulo"=>$max->titulo,
        "card" => $max->imagenbox,
        "slug" => $max->slug,
        "categoria" => @$category,
        "subcategoria" => @$subcategory,
        //'date_publish'=> @Carbon::parse($max->date_publish)->locale('es')->isoFormat('d MMM Y'),
        'date_publish' =>  @strftime("%d %b %Y", date (strtotime($max->date_publish )) ),
        'lectura' => @Post::TimeEstimate($max->contenido)
       );

       //tags

       $articulo->publicado = @Carbon::parse($articulo->date_publish)->locale('es')->isoFormat('D \\d\e MMMM\\,\\ YYYY');
       $articulo->tiempoLectura = @Post::TimeEstimate($articulo->contenido);


        return view('frontend.post',['postmax'=>$postmax,'categoria'=>$category,'subcategoria'=>$subcategory,'videos'=>$videos,'columns'=>$columns,'articulo'=>$articulo,'relacionados'=>$relacionados,'next'=>$next,'previous'=>$previous]);

    }

    public function suscribirse(Request $request){


        /*$validated = $request->validate([
            'email' => 'required|unique:suscriptions|max:255',
        ]);*/

        $news = new Suscription();
        $news->email = $request->email;
        $news->temas = serialize($request->interes);
        $news->save();

        return response()->json(['rpta'=>"ok"]);
    }

    public function posttype($posttype){


        $new_url = "https://www.claro.com.pe/hablando-claro/";

        return redirect($new_url);

        $type = PostType::where('tipo',$posttype)->first();
        $arts = Post::where('post_type_id',$type->id)->orderBy('id', 'desc')->where('estado',1)->get();

        foreach($arts as $post){

            $result[] = array(
                "id" =>$post->id,
                "categoria"=> @Post::getCategory($post->id)['category'],
                "subcategoria"=> @Post::getCategory($post->id)['subcategory'],
                "slug" => $post->slug,
                "titulo" => $post->titulo,
                "banner" => $post->banner,
                "card" => $post->imagenbox,
                "date_publish" => @Carbon::parse($post->date_publish)->locale('es')->isoFormat('d MMM Y'),
               // "date_publish" =>  @strftime("%d %b %Y", date (strtotime($col->date_publish )) ),
                "lectura" => @Post::TimeEstimate($post->contenido),
                'foto' => @$post->author->imagen,
                "nombre" => @$post->author->nombre,
                "cargo" => @$post->author->cargo
            );

        }

        $articulos = collect($result);



        $categorias = Category::wherenull('parent_id')->get();

        // dd( $articulos );

        return view('frontend.articulos',['articulos'=>$articulos,'posttype'=>$type,"categorias"=>$categorias]);
    }

    public function resultados($word){


        $new_url = "https://www.claro.com.pe/hablando-claro/";

        return redirect($new_url);

        $result = [];
        $articulos = Post::where('posts.titulo','LIKE',"%{$word}%")->where('estado',1)->orderBy('date_publish','desc')->get();

        foreach($articulos as $post){

                $result[] = array(
                    "category"=> @Post::getCategory($post->id)['category'],
                    "subcategory"=> @Post::getCategory($post->id)['subcategory'],
                    "slug" => $post->slug,
                    "titulo" => $post->titulo,
                    "banner" => $post->banner,
                    "imagen" => $post->imagenbox,
                    "date_publish" => @Carbon::parse($post->date_publish)->locale('es')->isoFormat('d MMM Y'),
                   // "date_publish" =>  @strftime("%d %b %Y", date (strtotime($col->date_publish )) ),
                    "id" => $post->id
                    );

        }

        $posts = collect($result);

        return view('frontend.buscar',['posts'=>$posts,'word'=>$word]);
    }

    public function buscar(Request $request){


        $new_url = "https://www.claro.com.pe/hablando-claro/";

        return redirect($new_url);

        // $posts = DB::table('posts')
        //             ->where('posts.titulo','LIKE',"%{$request->word}%")
        //             ->leftJoin('categories', 'posts.category_id', 'categories.id')
        //             ->select('posts.titulo as titulo', 'posts.slug as slug', 'categories.slug as slugcategory', 'posts.id as post_id')
        //             ->limit(6)
        //             ->get();



        $result = [];
        $posts = Post::where('titulo','LIKE',"%{$request->word}%")->where('estado',1)->get();
        // $posts = Post::where('estado',1)->get();

         foreach($posts as $post){
             if(isset($post->categories[0]->parent)){
                 $result[] = array(
                    "category"=> @Post::getCategory($post->id)['category']->slug,
                    "subcategory"=> @Post::getCategory($post->id)['subcategory']->slug,
                     "slug" => $post->slug,
                     "titulo" => $post->titulo,
                    );
             }else{
                $result[] = array(
                    "category"=> @Post::getCategory($post->id)['category']->slug,
                    "subcategory"=>"",
                    "slug" => $post->slug,
                    "titulo" => $post->titulo,
                   );
             }
         }

        $buscados = [];
        foreach ($result as $post) {
            if ( ! is_null( $post['category'] ) ) {
                array_push($buscados, $post['category']);
            }
        }
        $counted = array_count_values($buscados);
        asort($counted);
        $counted = array_reverse($counted);
        $mas_buscados = [];
        $limit = 100;
        $i = 1;
        foreach ($counted as $key => $value) {
            if ( $i <= $limit) {
                array_push( $mas_buscados, Category::where('slug', $key)->select('nombre', 'slug')->get() );
                $i++;
            }
        }

        // dd( $counted, $mas_buscados, $result);

        return response()->json(['rpta'=>'ok',"data"=>$result, 'mas_buscados'=>$mas_buscados]);
    }


    public function tag($tag){

        $new_url = "https://www.claro.com.pe/hablando-claro/";

        return redirect($new_url);


        $new_url = "https://www.claro.com.pe/hablando-claro/tag/?=".$tag;

        return redirect($new_url);

        $tag = Tag::where('slug',$tag)->first();


        foreach($tag->posts as $post){

            $result[] = array(
                "categoria"=> @Post::getCategory($post->id)['category'],
                "subcategoria"=> @Post::getCategory($post->id)['subcategory'],
                "slug" => $post->slug,
                "titulo" => $post->titulo,
                "banner" => $post->banner,
                "card" => $post->imagenbox,
                //"date_publish" => @Carbon::parse($col->date_publish)->locale('es')->isoFormat('d MMM Y'),
                "datep_publish" =>  @strftime("%d %b %Y", date (strtotime($post->date_publish )) ),
                );

        }

        $articulos = collect($result);


        $categorias = Category::wherenull('parent_id')->get();

        return view('frontend.tags',['articulos'=>$articulos,'tag'=>$tag,"categorias"=>$categorias]);

    }

    public function getOptResult(Request $request){
         $result = ResultQuiz::where('quiz_id',$request->quiz_id)
        ->where('question_id',$request->question_id)->first();

        return response()->json($result);
    }

    // public function testing(){

    //     $redirect ="";
    //     $categorias = Category::orderBy('id','desc')->get();

    //     foreach($categorias as $cat){

    //         if($cat->parent_id>0){
    //             $old_url = "/".$cat->parent->slug."/".$cat->slug;
    //             $new_url = 'https://www.claro.com.pe/hablando-claro/'.$cat->parent->slug."/".$cat->slug;
    //         $redirect .="'".$old_url."' => '".$new_url."',<br>";
    //         }else{

    //             $old_url = "/".$cat->slug;
    //             $new_url = 'https://www.claro.com.pe/hablando-claro/'.$cat->slug;
    //             $redirect .="'".$old_url."' => '".$new_url."',<br>";
    //         }
    //     }


    //     foreach($categorias as $cat){
    //        if($cat->parent_id>0){


    //        if(count($cat->posts)>0)
    //        {
    //            foreach($cat->posts as $post){
    //                //dump(env('APP_URL')."/".$cat->parent->slug."/".$cat->slug."/".$post->slug);

    //                $old_url = "/".$cat->parent->slug."/".$cat->slug."/".$post->slug;
    //                $new_url = 'https://www.claro.com.pe/hablando-claro/'.$cat->parent->slug."/".$cat->slug."/post/?=".$post->slug;


    //               $redirect .="'".$old_url."' => '".$new_url."',<br>";
    //            }
    //        }

    //        }
    //     }




    //    // dd($redirect);
    //     return view('testing.index',['redireccionar'=>$redirect]);
    // }


    //API
    public function apiCategoria(){

         $categorias = Category::whereNull('parent_id')->get();
        $category=null;
        $categoria = null;
         foreach($categorias as $cat){
            $subcat=null;
            if($cat->pariente){
                foreach($cat->pariente as $sc){
                    $subcat[] = [
                        'id'=>$sc->id,

                        'nombre'=>$sc->nombre,
                        'url'=>$sc->slug
                    ];
                }
            }
                $category[] = [
                    'id'=>$cat->id,

                    'url'=> $cat->slug,
                    'childs'=>$subcat,
                ];



         }



         $cols = Post::where('estado',1)->whereNotNull('author_id')->orderBy('date_publish','desc')->take(4)->get();

        //column
        foreach($cols as $key=> $col){



                $colum[] = array(
                    "id" => $col->id,
                    "titulo" => $col->titulo,
                    "card" => $col->imagenbox,
                    "slug" => $col->slug,

                    //'date_publish'=> @Carbon::parse($col->date_publish)->locale('es')->isoFormat('d MMM Y'),
                    'date_publish' =>  @strftime("%d %b %Y", date (strtotime($col->date_publish )) ),
                    'lectura' => @Post::TimeEstimate($col->contenido),
                    'foto' => @$col->author->imagen,
                    'nombre' => @$col->author->nombre,
                    'cargo'=>$col->author->cargo
                );


         }
        $columns = collect($colum);

        return response()->json(['categorias'=>$category,'opinion'=>$columns]);

        // return view('frontend.category',['videos'=>$videos,'columns'=>$columns,'categorias'=>$categorias,'articulos'=>$articulos,'categoria'=>$categoria,'category'=>$category,'subcategoria'=>$subcategoria]);
     }

     public function apiPost($slug){
        $post = Post::where('slug',$slug)->first();

        return response()->json($post);
     }

    public function testing(){

        // $url = 'https://www.claro.com.pe/hablando-claro/innovacion/post/?=ya-conoces-el-nuevo-servicio-que-redefine-la-experiencia-de-ver-television-en-el-peru';

        // $getdata =  Http::withHeaders(['Content-Type' => 'application/json'])->post('https://api-prod-pe.prod.clarodigital.net/api/PE_MS_FE_POSTS/createPost',
        // [
        //     'url'=>$url
        // ]);

        // dd($getdata);

        // $baseurl= 'https://www.claro.com.pe/hablando-claro';

        // $consulta = Category::all();
        // $categorias=null;
        // $pariente=null;
        // $huerfanos=null;
        // $urlfinal=null;
        // foreach($consulta as $cat){

        //     if(!isset($cat->parent_id)){
        //         $categorias[] = $cat;
        //     }else{
        //         $subcategorias[]=$cat;
        //     }

        // }


        // if($subcategorias!=null){
        //     foreach($subcategorias as $sub){

        //     $scat =  Category::where('id',$sub->id)->first();

        //         $posts = $scat->posts;
        //         foreach($posts as $row){
        //             if($row->estado==1){
        //                 $urlfinal[] =  ['url'=>$baseurl."/".$scat->parent->slug."/".$scat->slug."/post/?=".$row->slug];
        //             }
        //         }

        //     }

            //dd($urlfinal);
            // foreach($subcategorias as $sub){

            //     $categoria = Category::where('id',$sub->id)->first();

            //     if (array_key_exists($categoria->parent->id, $categorias)) {
            //         $pariente[]=$categoria->parent->id;
            //     }

            // }
        // }

        // foreach($categorias as $cat){

        //     $cat = Category::where('id',$cat->id)->first();

        //     $posts = $cat->posts;

        //         foreach($posts as $row){
        //             if($row->estado==1){
        //                 $urlfinal[] = ['url'=>$baseurl."/".$cat->slug."/post/?=".$row->slug];
        //             }
        //         }

        // }

        // //anexamos post a categoria huerfana
        // if($pariente!=null){

        //     $huerfanos = array_diff($categorias,$pariente);



        //     foreach($huerfanos as $row){
        //         $hcat = Category::find($row);

        //         dd($hcat->posts);

        //         $posts = $hcat->posts;
        //         foreach($posts as $row){
        //             $urlfinal[] = $baseurl."/".$hcat->slug."/post/?=".$row->slug;

        //         }
        //     }


        // }else{
        //     foreach($categorias as $row){
        //         $hcat = Category::find($row);



        //         $posts = $hcat->posts;
        //         foreach($posts as $row){

        //         $urlfinal[] = $baseurl."/".$hcat->slug."/post/?=".$row->slug;

        //         }

        //     }
        // }


       // dd($urlfinal);


        // $result = [];
        // $posts = Post::where('estado','1')->get();
        // // $posts = Post::where('estado',1)->get();

        //  foreach($posts as $post){

        //     dd($post->categories[1]);

        //      if(isset($post->categories[0]->parent)){
        //          $result[] = array(

        //              "url"=> $baseurl.Post::getCategory($post->id)['category']->slug."/".Post::getCategory($post->id)['subcategory']->slug."/".$post->slug
        //             );
        //      }else{
        //         $result[] = array(
        //             "url"=> $baseurl.Post::getCategory($post->id)['category']->slug."/".$post->slug
        //            );
        //      }
         //}


    //      Storage::disk('public')->put('postfilter.json',collect($urlfinal));
    //      dd("fin");


    //    $listado = json_decode(file_get_contents(storage_path() . "/app/public/resultados.json"), true);


        // $url = 'https://www.claro.com.pe/hablando-claro/innovacion/post/?=ya-conoces-el-nuevo-servicio-que-redefine-la-experiencia-de-ver-television-en-el-peru';


        // $baseurl= 'https://www.claro.com.pe/hablando-claro/';



        // foreach($listado as $key => $value){

        //    $uri =  explode("/",$value['url']);
        //    //dd($uri);

        //    if((count($uri)) == 6){

        //     $urfinal = $baseurl.$uri[4]."/post/?=".$uri[5];
        //    }

        //    if((count($uri)) == 7){
        //     $urfinal = $baseurl.$uri[4]."/".$uri[5]."/post/?=".$uri[6];
        //    }


        //      $getdata = Http::withHeaders(['Content-Type' => 'application/json'])->post('https://api-prod-pe.prod.clarodigital.net/api/PE_MS_FE_POSTS/createPost',
        //     [
        //         'url' => $urfinal,
        //     ]);


        //     print_r( $getdata );
        // };


        $categoria = Category::where('id',4)->first();
        // $tags = Tag::all();
        // $autores = Author::all();
        // $tipos = PostType::all();

        // $ptags = PostTag::all();

        //dd($ptags);

            // $post = Post::find('415');
            // dd($post->tags[0]->slug);
        $articulos = [];

        // dd(count($categoria->posts));
        // dd("fin");
      //  DB::setDefaultConnection("pgsql");

       // foreach($categorias as $cat){


                foreach($categoria->posts as $post){

                   // dd(isset($post->tags->slug));



                    $found = DB::connection("pgsql")->table("posts")->where('id',$post->id)->count();

                     if($found==0){
                            $articulos= [
                            "id" => $post->id,
                            "title" => $post->titulo,
                            "slug" => $post->slug,
                            "banner" => $post->banner,
                            "card" => $post->imagenbox,
                            "movil" => $post->movil,
                            "tablet" => $post->tablet,
                            "standout" => $post->destacado,
                            "state"=>$post->estado,
                            "publish_date" => $post->date_publish,
                            'category_id' => $categoria->id,
                            'template_id'=>1,
                            'post_type_id'=> $post->post_type_id,
                            'author_id' => $post->author_id,
                            'meta_description' => $post->meta_description,
                            'meta_title' => $post->meta_titulo,
                            'meta_image'=>$post->meta_image,
                            'meta_keyword' =>$post->meta_keyword,
                            'twitter_site' => $post->twitter_site,
                            'twitter_create' => $post->twitter_create,
                            "created_at" => $post->updated_at
                        ];




                        $id =  DB::connection("pgsql")->table("posts")->insertGetId($articulos);

                        $contenido = [
                                "content_text"=>$post->contenido,
                                "post_id" => $id
                        ];

                        DB::connection("pgsql")->table("contents")->insert($contenido);

                        if(isset($post->tags[0]->slug)){

                            foreach($post->tags as $row){
                                $tag_id =  $row->id;

                                DB::connection("pgsql")->table("post_tag")->insert(['post_id'=>$id, 'tag_id'=>$tag_id ]);
                            }
                        }
                   }
                }
      // }


      dd($articulos);

    // $categoria = Category::where('id',19)->first();


    // foreach($listado as $art){



    //     $post = Post::where('slug',$art['slug'])->first();


    //    // $nulos = DB::table("posts")->where('slug',$post->slug)->whereNull('meta_description')->count();


    //         $metas = [
    //             "meta_description" => @$post->meta_description,
    //             "meta_title" => @$post->meta_titulo,
    //             "meta_image" => "/storage/".@$post->meta_image,
    //             "twitter_site" => @$post->twitter_site,
    //             "twitter_create" => @$post->twitter_create,
    //             "meta_keyword" => @$post->meta_keywords,
    //         ];



    //         DB::connection("pgsql")->table("posts")->where('slug',$post->slug)->update($metas);

    //         var_dump($metas);



    //         //$data = DB::table("posts")->where('slug',$post->slug)->first();

    //         //print_r($metas);


    // }


    // dd("fin");

    // DB::setDefaultConnection("pgsql");

    // DB::table("posts")->where('slug',$post->slug)->update($metas);


    // dd($metas);

        // foreach($categorias as $cat){

        //     $categorias = [
        //         'name' => $cat->nombre,
        //         'slug' => $cat->slug,
        //         'metaDescription'=>$cat->meta_description,
        //         'metaTitle'=>$cat->meta_titulo,
        //         'metaImage'=>$cat->meta_image,
        //         'metaKeyword'=>$cat->meta_keywords,
        //         'parentId'=>$cat->parent_id,
        //     ];

        //     DB::table('categories')->insert($categorias);
        // }


        // foreach($tags as $tag){

        //     $arreglo = [
        //         'name' => $tag->nombre,
        //         'slug' => $tag->slug,

        //     ];

        //     DB::table('tags')->insert($arreglo);
        // }


        // foreach($autores as $row){

        //     $arreglo = [
        //         'name' => $row->nombre,
        //         'title'=> $row->titulo,
        //         'image' => $row->imagen,
        //         'position'=>$row->cargo

        //     ];

        //     DB::table('authors')->insert($arreglo);
        // }

        // foreach($tipos as $row){

        //     $arreglo = [
        //         'name' => $row->tipo,
        //     ];

        //     DB::table('post_type')->insert($arreglo);
        // }

        // foreach($ptags as $row){

        //    $contador = DB::table('posts')->where('id',$row->post_id)->count();
        //    if($contador>0){
        //         $arreglo = [
        //             'post_id' => $row->post_id,
        //             'tag_id' => $row->tag_id
        //         ];

        //         DB::table('post_tag')->insertOrIgnore($arreglo);
        //     }
        // }




    }

    public function getNoticias(Request $request){
       // dd($request->innovacion);


       $items = [];
       if($request->innovacion=="Si"){
            array_push($items,1);
       }
       if($request->entrenimiento=="Si"){
            array_push($items,2);
       }
       if($request->negocios=="Si"){
            array_push($items,3);
       }
       if($request->seguridad=="Si"){
            array_push($items,1);
       }
       if($request->aprendiendo_claro=="Si"){
            array_push($items,1);
       }

       if($request->compromiso=="Si"){
            array_push($items,6);
       }

       //dd($items);

       $post  = [];
       // dd($items);
       $seleccion = array_rand($items,1);

       $indice = $items[$seleccion];

            $category = Category::where('parent_id',$indice)->inRandomOrder()->first();
            $articulos = $category->lastposts;

            $base = "https://www.claro.com.pe/hablando-claro/";
            $baseimg = "https://hablandoclaro.claromarketingtool.pe/storage/";
            foreach($articulos as $row){

                $post[] = [
                    "imagen"=>$baseimg.$row->imagenbox,
                    "titulo"=>$row->titulo,
                    "slug"=> $base.$row->categories[0]->slug."/".$row->categories[1]->slug."/".$row->slug
                ];
            }



       //dd($post);

        return response()->json($post);
    }


}
