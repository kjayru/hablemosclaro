<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Suscription;
use App\Models\PostType;
use App\Models\Author;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use App\Models\Visit;

class AdminController extends Controller
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
        $cont_visitas = Visit::count();
        $cont_publicaciones = Post::where('estado',1)->count();
        $cont_categorias = Category::count();
        $cont_autores = Author::count();

        return view('backend.dashboard',[
            'cont_autores'=>$cont_autores,
        'cont_categorias'=>$cont_categorias,
        'cont_publicaciones'=>$cont_publicaciones,
        'cont_visitas'=>$cont_visitas,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function media()
    {

        return view('backend.media.index');
    }

}
