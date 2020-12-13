<?php

use Illuminate\Database\Seeder;
use App\Post;

class postTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $title_list = ['好きなロックマンシリーズ','好きなマンガ雑誌','今日の夕飯','牛丼屋派閥調査'];
        
        
        $user_list = ['sugimoto1','kobayasi2','murayama3','tanaka4'];
        
        
        $text_list = ['タダチニトウヒョウシタマエ','とりあえず3大雑誌から','腹が減ったらプログラミングはできぬ','チェーン３社から'];
        
        
        // $array = [['title1','user1','QA1','QB1','QC1'], ['title2','user2','QA2','QB2','QC2'],['title3','user3','QA3','QB3','QC3']];
        
        // foreach($array as $t){
        //     Post::create([
        //         'title' => $t[0],
        //         'user' => $t[1],
        //         'a1' => $t[2],
        //         'a2' => $t[3],
        //         'a3' => $t[4]
        //         ]);
        // 
        
        foreach($title_list as $t => $d){ 
            Post::create([

            'title' => $d,
            'user' => $user_list[$t],
            'text' => $text_list[$t]
            // 'a1' => $answerA_list[$t],
            // 'a2' => $answerB_list[$t],
            // 'a3' => $answerC_list[$t]
            ]);
    }
        
    }
}
