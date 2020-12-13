<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function answers()
    {
        return $this->hasMany(Answer::class, 'post_id');
    }
    
    public function players()
    {
        return $this->hasMany(Player::class, 'post_id');
    }
    
        public function comments()
    {
        return $this->hasMany(Player::class, 'post_id');
    }
    
    
}
