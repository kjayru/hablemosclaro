<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Configuration;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $config = Configuration::find(1);

        return view('backend.config.index',['conf'=>$config]);
    }




    public function update(Request $request, $id)
    {

        $conf = Configuration::find($id);
        $conf->titulo = $request->titulo;
        $conf->descripcion = $request->descripcion;
        $conf->keywords = $request->keywords;
        $conf->canonical = $request->canonical;
        $conf->facebook_app_id = $request->facebookid;
        $conf->facebook_admin_id = $request->facebookadminid;
        $conf->twitter_id = $request->twitterid;
        $conf->imagen_facebook = $request->imagenfacebook;
        $conf->imagen_twitter = $request->imagentwitter;


        $conf->save();

        return redirect(route('configuration.index'))
        ->with('info', 'Configuración actualizada con éxito.');
    }



}
