<?php

use Illuminate\Database\Seeder;
use App\Comment;

class commentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $id_list = ['1','2','3','4'];
        $player_name_list = ['pn1','pn2','pn3','pn4'];
        $comment_list = ['草生える','竜虎相打つ','賛否両論','波紋を呼ぶ'];
         foreach($id_list as $id => $i){ 
            Comment::create([

            'post_id' => $i,
            'player_name' => $player_name_list[$id],
            'comment' => $comment_list[$id]

            ]);
        }
    }
}
