<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Post extends Model
{
    /**
     * The attributes that are mass fillable
     * 
     */
    protected $fillable = [
        'body',
        'title'
    ];

    /**
     * The relationship that each post belongs
     * to a user
     */
    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
