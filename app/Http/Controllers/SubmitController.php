<?php

namespace App\Http\Controllers;

use App\Post;
use App\Answer;
use App\Submit;

use Illuminate\Http\Request;

class SubmitController extends Controller
{
    public function index()
    {
        //  var_dump('index here!');exit;
    }
    
    public function create()
    {
        return view('posts.submit');
    }
    
    public function store(Request $request)
    {
        // var_dump($request->input('answers'));exit;
        $post = new Post();
        $post->user = $request->input('user');
        $post->title = $request->input('title');
        $post->text = $request->input('text');
        // (user_idを作る)
        $post->save();
        
        // $answers = $request->input('answers');
        foreach ($request->input('answers') as $val){
            $answer = new Answer();
            $answer->choices = $val;
            $answer->post_id = $post->id;
            $answer->save();
        }
        
        // $answer->choices = $request->input()
        
        
        // return view('posts.index');
        return redirect(route('index'));
    }
}
