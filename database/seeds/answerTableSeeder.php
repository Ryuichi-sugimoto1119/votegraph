<?php

use Illuminate\Database\Seeder;
use App\Answer;

class answerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $id_list = ['1','2','3','4'];
        $choices_list = ['QA1','QA2','QA3'];
    
     foreach($id_list as $id => $i){ 
        foreach ($choices_list as $v) {
           Answer::create([
            'post_id' => $i,
            'choices' => $v
            ]);
        }
     }
    }
}
