<?php

namespace App\Http\Controllers;

use App\Post;
use App\Answer;
use App\Player;
use App\Comment;


use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        //
    }
    
    public function show($id){
        $posts = Post::find($id);
        $players = new Player;
        $answers = new Answer;
        $comments = new Comment;
        return view('posts.comment',compact('posts'));
    }
    
    public function create()
    {
        return view('posts.show');
        // return view('posts.show');
    }
    
    public function store(Request $request)
    {
        $comments = new Comment;
        $answers = new Answer;
        $players = new Player;

        $id = $request->input('id');
        $posts = Post::find($id);
        $comments->post_id = $id;
        $comments->player_name = $request->input('player_name');
        $comments->comment = $request->input('comment');
        $comments->save();
        
        
        
        // クエリ文字列からuser_idを取得
        $user_id = $request->input('user_id');
        $answer_id = 0;
        $answerList = $answers->where('post_id',$id)->get();
        
        $player_result = [];
        foreach ($posts as $post) {
            $choice_result = [];
            $post_id = $posts->id;
            $answer_list = $posts->answers;
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
        
        
         foreach($answerList as $al) {
            $playerChoices = $players->where('answer_id',$al->id)->get();
            $playerChoicesList[$al->choices]['data'] = $playerChoices;
            $playerChoicesList[$al->choices]['count'] = count($playerChoices);
         }
        
        $commentList = $comments->where('post_id',$id)->get();
        return view('posts.show',compact('posts','players','playerChoicesList','comments','commentList','player_result','answer_id','user_id'));
    }
}
