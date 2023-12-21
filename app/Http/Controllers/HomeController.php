<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    private $post;
    private $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Post $post, User $user)
    {
        $this->middleware('auth');
        $this->post=$post;

        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all_posts = $this->homepage_posts();
        $suggestedUsers = $this->getSuggestedUsers();

        return view('users.home')
        ->with('all_posts',$all_posts)
        ->with('suggestedUsers',$suggestedUsers);
    }

    public function homepage_posts(){

        $all_posts = $this->post->latest()->get();
        $filtered_posts = [];

        //filter posts of user we don't follow
        foreach($all_posts as $post)
        {
            if($post->user->isFollowed() || $post->user_id === Auth::user()->id)
            {
                $filtered_posts[] = $post;
            }
        }
        return $filtered_posts;
    }

    public function getSuggestedUsers()
    {
        $all_users = $this->user->all()->except(Auth::user()->id);
        $suggested_users = [];

        foreach($all_users as $user){
            if(!$user->isFollowed()){
                $suggested_users[] = $user;
            }
        }
        return $suggested_users;
    }

    public function search (Request $request)
    {
        $users = $this->user->where('name','like','%'.$request->search . '%')->get();

        return view('users.search')
        ->with('users',$users)
        ->with('search',$request->search);
    }

}
