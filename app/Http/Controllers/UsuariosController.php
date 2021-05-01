<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Roles;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    /**
     * Despliega la vista index de control de usuarios
     *
     * @return view
     */
    public function index()
    {
        return view('app.users.index');
    }

    /**
     * Despliega la vista para creacion de usuarios
     *
     * @return view
     */
    public function nuevo()
    {
        return view('app.users.crear_usuario');
    }

    /**
     * Registra un nuevo usuario. Valida la existencia del correo
     *
     * @param Request $request
     * @return redirect
     */
    public function postNuevo(Request $request)
    {
       
        $exist_user = User::where('email',$request->input('email'))->first();

        if(!is_null($exist_user)){
            return redirect()->back()->withErrors('El correo electronico ya existe.');
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        $role = new Roles();
        $role->user_id = $user->id;
        $role->rol_tipo = $request->input('rol'); 
        $role->save();
        
        return redirect('/users/index');
    }

    /**
     * Despliega la vista de edicion de un usuario
     *
     * @param [integer] $user_id
     * @return view
     */
    public function editar ($user_id){
        $user = User::find($user_id);
        $rol = Roles::where('user_id', $user_id)->first();

        return view('app.users.editar_usuario',array('user' => $user, 'rol' => $rol));
    } 

    /**
     * Modifica un registro de usuario utilizando su llave primaria
     *
     * @param [integer] $user_id
     * @param Request $request
     * @return view
     */
    public function postEditar($user_id, Request $request){
        
        $user = User::find($user_id);
        
        if(!is_null($user)){
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->save();

            $role = Roles::where('user_id', $user->id)->first();
            $role->rol_tipo = $request->input('rol'); 
            $role->save();
        }

        return redirect('/users/index');
    }

    /**
     * Elimina un registro por su llave primaria
     *
     * @param [type] $user_id
     * @return json
     */
    public function eliminar($user_id){
        $user = User::find($user_id);

        if(!is_null($user)){
            $user->delete();
        }

        return response()->json(['user' => $user]);
    }


    /**
     * Api json para obtener el registro de todos los usuarios en el sistema
     *
     * @return json
     */
    public function apiGet()
    {

        $request = request();

        // Maneja el ordenamiento requerido
        if (request()->has('sort')) {
            list($sortCol, $sortDir) = explode('|', request()->sort);
            $query                   = User::orderBy('users.'.$sortCol, $sortDir);
        } else {
            $query = User::orderBy('users.id', 'asc');
        }

        if ($request->exists('filter')) {
            $query->where(function ($q) use ($request) {
                $value = "%{$request->filter}%";
                $q->where('users.name', 'like', $value);
            });
        }

        $query->join('roles','roles.user_id','=','users.id');
        $query->select('users.*', 'roles.rol_tipo');

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
