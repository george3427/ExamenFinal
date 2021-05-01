<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\UserPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPostController extends Controller
{
    /**
     * Carga la vista de entrada para una nueva publicacion
     *
     * @return void
     */
    public function nuevo()
    {
        return view('app.post.crear_post');
    }

    /**
     * Crea un nuevo post apartir de los datos de entrada de la Request
     *
     * @param Request $request
     * @return redirect
     */
    public function postNuevo(Request $request)
    {
        $post = new UserPost();
        $post->titulo = $request->input('titulo');
        $post->contenido = $request->input('contenido');
        $post->user_id = Auth::user()->id;
        $post->save();
        
        return redirect('/wiki/index');
    }

    /**
     * Muestra un determinado post por su llave primeria
     *
     * @param [integer] $post_id
     * @return view
     */
    public function ver($post_id){
        
        $post = UserPost::find($post_id);
        $username = (User::find($post->user_id))->name;
        
        return view('app.post.ver_post',array('post' => $post, 'username' => $username));
    }

    /**
     * Carga la vista para edicion de un determinado post
     *
     * @param [integer] $post_id
     * @return view
     */
    public function editar ($post_id){
        $post = UserPost::find($post_id);

        return view('app.post.editar_post',array('post' => $post));
    } 
    
    /**
     * Modifica un determinado post utilizando su llave primaria contenida en los parametros
     * de la request.
     *
     * @param [integer] $post_id
     * @return redirect
     */
    public function postEditar($post_id, Request $request){
        
        $post = UserPost::find($post_id);
        
        if(!is_null($post)){
            $post->titulo = $request->input('titulo');
            $post->contenido = $request->input('contenido');
            $post->save();
        }

        return redirect('/wiki/index');
    }
    
    /**
     * Elimina un determinado post utilizando su relacion con la llave primaria
     *
     * @param [integer] $post_id
     * @return json
     */
    public function eliminarPost($post_id){
        $post = UserPost::find($post_id);

        if(!is_null($post)){
            $post->delete();
        }

        return response()->json(['post' => $post]);
    }

}
