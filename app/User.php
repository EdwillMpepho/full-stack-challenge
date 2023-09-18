<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /*
    public function posts() {
        return $this->hasMany(Post::class);
    }
    
    /**
     * The user role that must be returned in a stirng
     * 
     */
    public function role(): Attribute
    {
        return new Attribute(
            fn($value) => ['admin','supervisor','executive'][$value]
        );
    }
}
