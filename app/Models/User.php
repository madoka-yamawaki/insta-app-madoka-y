<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //get all post of the user
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    //to get all followers
    public function followers()
    {
        return $this->hasMany(Follow::class,'following_id');
    }

    //to get all following
    public function followings()
    {
        return $this->hasMany(Follow::class,'follower_id');
    }

    //follower_id       following_id        User
    //1                 2                    1-followers - 5,8
    //1                 3                    2-following - 4,5
    //1                 5
    //2                 4
    //2                 5
    //5                 1
    //5                 2
    //8                 1

    //to check if user already follow the person
    public function isfollowed()
    {
        return $this->followers()->where('follower_id',Auth::user()->id)->exists();
    }
}
