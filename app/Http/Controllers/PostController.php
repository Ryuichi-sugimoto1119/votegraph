<?php

namespace App\Http\Controllers;

use App\Post;
use App\test;
use App\Submit;
use App\Answer;
use App\Player;
use App\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $posts = Post::with('answers')->get();
        $posts = $posts->sortByDesc('created_at')->values()->all();
        // var_dump($posts);exit;
         // クエリ文字列からuser_idを取得
        $user_id = $request->input('user_id');
        // $answers = new Answer;
        $players = new Player;
      
        
        $player_result = [];
        foreach ($posts as $post) {
            $choice_result = [];
            $post_id = $post->id;
            $answer_list = $post->answers;
            foreach ($answer_list as $answer) {
                $tmp = $players->where('post_id',$post_id)->where('answer_id',$answer->id)->get();
                $tmp_cnt = count($tmp);
                $choice_result['data'][] = $tmp_cnt;
                $choice_result['label'][] = $answer->choices;
            }
            if (count($choice_result) > 0) {
                $player_result[$post_id]['data'] = implode(',', $choice_result['data']);
                $player_result[$post_id]['label'] = implode(',', $choice_result['label']);
            } else {
                $player_result[$post_id]['data'] = '';
                $player_result[$post_id]['label'] = '';
            }
        }
        
        
        // var_dump($player_result);exit;
        // return view('posts.index', compact('posts','answers'));
        return view('posts.index', compact('posts', 'player_result','user_id'));
         // compactで変数を打ち込むときは、$は無しで、シングルクォーテーション。
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
    //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // $posts = Post::find($id);
        // $post->delete();
        // return view('posts.index', compact('posts','comments'));
    }
}
