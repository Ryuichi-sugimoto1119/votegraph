<?php

use Illuminate\Database\Seeder;
use App\Player;

class playerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $answer_list = ['A1','A2','A3'];
        $id_list = ['1','2','3','4'];
        $player_list = ['p1','p2','p3','p4'];
        
     foreach($answer_list as $answer => $a){ 
           Player::create([
            
            'answer_id' => $a,
            'post_id' => $id_list[$answer],
            'player' => $player_list[$answer]
            ]);
        }
     }
}
