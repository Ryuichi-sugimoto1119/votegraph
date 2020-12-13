<?php

namespace App\Http\Controllers;

use App\Post;
use App\Answer;
use App\Player;
use App\Comment;

use Illuminate\Http\Request;

class EditController extends Controller
{
    public function index()
    {
        
    }
    
    public function show(Request $request,$id)
    {   
        $posts = Post::find($id);
        $players = new Player;
        $answers = new Answer;
        $comments = new Comment;
        
        $user_id = $request->input('user_id');
        $answer_id = 0;
        $answerList = $answers->where('post_id',$id)->get();
        $playerVoteList = [];
        
        foreach($answerList as $al) {
            // var_dump($al->id, $al->choices);
            $playerChoices = $players->where('answer_id',$al->id)->get();
            $playerChoicesList[$al->choices]['data'] = $playerChoices;
            $playerChoicesList[$al->choices]['count'] = count($playerChoices);
             
             foreach($playerChoices as $value) {
                if ($value->player == $user_id) {
                    $answer_id = $value->answer_id;
                }
                array_push($playerVoteList, $value->player);
            }
        }
        $playerVoteList = array_unique($playerVoteList);

        $answerList = $answers->where('post_id',$id)->get();
        // var_dump($answers);exit;
        $commentList = $comments->where('post_id',$id)->get();

        return view('posts.edit',compact('posts','playerChoicesList','commentList','playerVoteList','answer_id','user_id'));
    
    }
    
     public function store(Request $request)
    {
        // var_dump($request->input('id'), $request->input('user') , $request->input('title') , $request->input('text'));exit;
        $id = $request->input('id');
        $posts = Post::find($id);
        $posts->user = $request->input('user');
        $posts->title = $request->input('title');
        $posts->text = $request->input('text');
        $posts->save();
        
        $players = new Player;
        $answers = new Answer;
        $comments = new Comment;
        
        // クエリ文字列からuser_idを取得
        $user_id = $request->input('user_id');
        $answer_id = 0;
        $answerList = $answers->where('post_id',$id)->get();
        $answer_list = $posts->answers;
        
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
        
        $playerVoteList = [];
            foreach($answerList as $al) {
            // var_dump($al->id, $al->choices);
                $playerChoices = $players->where('answer_id',$al->id)->get();
                $playerChoicesList[$al->choices]['data'] = $playerChoices;
                $playerChoicesList[$al->choices]['count'] = count($playerChoices);
                foreach($playerChoices as $value) {
                    if ($value->player == $user_id) {
                        $answer_id = $value->answer_id;
                }
                array_push($playerVoteList, $value->player);
            }
        }
        $playerVoteList = array_unique($playerVoteList);
        
        $commentList = $comments->where('post_id',$id)->get();
        
        return view('posts.show',compact('posts','playerChoicesList','commentList','playerVoteList','answer_id','user_id','player_result'));
    }
    
    public function edit(Request $posts)
    {   
        // $post = new Post();
        // $post->user = $request->input('user');
        // $post->title = $request->input('title');
        // $post->text = $request->input('text');
        // $post->save();
        // return view('posts.show',compact('posts'));
    }
    
    public function update($posts)
    {   
        $post = new Post();
        $post->user = $request->input('user');
        $post->title = $request->input('title');
        $post->text = $request->input('text');
        $post->save();
        
        $players = new Player;
        $answers = new Answer;
        $answerList = $answers->where('post_id',$id)->get();
            foreach($answerList as $al) {
            // var_dump($al->id, $al->choices);
                $playerChoices = $players->where('answer_id',$al->id)->get();
                $playerChoicesList[$al->choices]['data'] = $playerChoices;
                $playerChoicesList[$al->choices]['count'] = count($playerChoices);
        }
        
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
        return view('posts.show',compact('playerChoicesList','player_result'));
    }
}
