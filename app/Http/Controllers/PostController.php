<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use App\Post;

class PostController extends Controller
{
  
  
  public function index(){
    
    $posts = \App\Post::paginate(2);
    $principal = \App\Post::where('featured', '1')->first();
              return view('home', compact('posts','principal'));     
        }
  
  
}
