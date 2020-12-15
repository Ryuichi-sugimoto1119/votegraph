<?php

namespace App\Http\Controllers;

use App\Post;
use App\Answer;
use App\Player;
use App\Comment;

use Illuminate\Http\Request;

class PlayerController extends Controller
{
    
    public function store(Request $request)
    {
        $request->session()->regenerateToken();
        
        // var_dump($request->input('user_id'));exit;
        // var_dump($request->input('user_id'), $request->input('answer_id'));exit;

        $players = new Player;
        $answers = new Answer;
        $comments = new Comment;
        
        $id = $request->input('id');
        $posts = Post::find($id);
        
        $players->post_id = $id;
        $players->player = $request->input('user_id');
        $players->answer_id = $request->input('answer_id');
        $players->save();
        
        $answerList = $answers->where('post_id',$id)->get();
        
         $player_result = [];
        foreach ($posts as $post) {
            $choice_result = [];
            $post_id = $posts->id;
            $answer_list = $posts->answers;
            // var_dump($answer_list);exit;
            
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
        
        // クエリ文字列からuser_idを取得
        $user_id = $request->input('user_id');
        $answer_id = 0;
         foreach($answerList as $al) {
            // var_dump($al->id, $al->choices);ex
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
    
 

        return view('posts.show',compact('posts','players','playerChoicesList','commentList','playerVoteList','answer_id','user_id','player_result'));

    }
    
    public function destroy(Request $request,$id)
    {
        $answers = new Answer;
        $comments = new Comment;
        
        $post_id = $request->input('id');
        $posts = Post::find($post_id);
        Player::where('answer_id', $id)->where('player', $request->input('user_id'))->delete();
        $players = new Player; 
        // データを削除した上でインスタンスを生成すること
        
        // クエリ文字列からuser_idを取得
        $user_id = $request->input('user_id');
        $answer_id = 0;
        $answerList = $answers->where('post_id',$post_id)->get();
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
            // var_dump($al->id, $al->choices);exit;
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
        // var_dump($playerChoicesList);exit;
        // var_dump($user_id,$answer_id);exit;
        return view('posts.show', compact('posts','players','playerChoicesList','playerVoteList','commentList','answer_id','user_id','player_result'));
    }
    
}
