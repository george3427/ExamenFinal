<?php

namespace App\Http\Controllers;

use App\Models\UserPost;
use Illuminate\Http\Request;

class WikiController extends Controller
{
    /**
     * Carga la vista principal de la wiki
     *
     * @return view
     */
    public function index(){
        return view('app.wiki.index');
    }

    /**
     * Api consumida por el paquete de vue table para listar todas las publicaciones
     *
     * @return void
     */
    public function apiGet()
    {

        $request = request();

        // Maneja el ordenamiento requerido
        if (request()->has('sort')) {
            list($sortCol, $sortDir) = explode('|', request()->sort);
            $query                   = UserPost::orderBy('user_posts.'.$sortCol, $sortDir);
        } else {
            $query = UserPost::orderBy('user_posts.id', 'asc');
        }

        if ($request->exists('filter')) {
            $query->where(function ($q) use ($request) {
                $value = "%{$request->filter}%";
                $q->where('user_posts.titulo', 'like', $value);
            });
        }

        $query->join('users','users.id','=','user_posts.user_id');
        $query->select('user_posts.*', 'users.name');

        $perPage = request()->has('per_page') ? (int) request()->per_page : null;

        // The headers 'Access-Control-Allow-Origin' and 'Access-Control-Allow-Methods'
        // are to allow you to call this from any domain (see CORS for more info).
        // This is for local testing only. You should not do this in production server,
        // unless you know what it means.
        return response()->json(
            $query->paginate($perPage)
        )
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET');
    }

}
