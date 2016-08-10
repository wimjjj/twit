<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'job', 'place'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts(){
        return $this->hasMany('Post');
    }

    public function comments(){
        return $this->hasMany('Comment');
    }

    public function friends()
    {
        return $this->belongsToMany('App\User', 'friend_user', 'user_id', 'friend_id');
    }

    public function addFriend(User $friend){

        $this->friends()->attach($friend->id);
        $friend->friends()->attach($this->id);
    }

    public function isFriend(User $user){
        return $this->friends->lists('id')->contains($user->id);
    }
}
