<?php

namespace App\Http\Controllers;

use App\Models\UserPost;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    
    public function index(){
        $posts = UserPost::count();
        return view('app.index', array('posts' => $posts));
    }


}
