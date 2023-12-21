<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    private $post;
    private $category;

    public function __construct(Post $post,Category $category)
    {
        $this->post = $post;
        $this->category = $category;
    }

    public function create()
    {
        $all_categories = $this->category->latest()->get();
        return view('users.posts.create')->with('all_categories',$all_categories);
    }

    public function store(Request $request)
    {
        //dd($request);

        $request->validate([
            'category'=>'required|array|between:1,3',
            'description'=>'required|min:1|max:1000',
            'image'=> 'required|mimes:jpeg,jpg,png,gif|max:1048',
        ]);

        $this->post->user_id = Auth::user()->id;
        $this->post->description =$request->description;
        $this->post->image = 'data:image/'. $request->image->extension().
                            ';base64,' . base64_encode(file_get_contents($request->image));
        $this->post->save();

        //save the categories selected to category post
        foreach($request->category as $category_id){
            $category_post[]=['category_id' => $category_id];
        }
        $this->post->categoryPost()->createMany($category_post);

        //return to homepage
        return redirect()->route('index');
    }

    public function show($id)
    {
        $post = $this->post->findOrFail($id);

        return view('users.posts.show')->with('post',$post);
    }

    public function edit($id)
    {
        $all_categories = $this->category->all();
        $post = $this->post->findOrFail($id);

        //get the selected categories
        $selected_categories = [];
        foreach($post->categoryPost as $category_post){
            $selected_categories[] = $category_post->category_id;
        }

        return view('users.posts.edit')
        ->with('all_categories',$all_categories)
        ->with('selected_categories',$selected_categories)
        ->with('post',$post);
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'category'=>'required|array|between:1,3',
            'description'=>'required|min:1|max:1000',
            'image'=> 'mimes:jpeg,jpg,png,gif|max:1048',
        ]);

        //get the post to be updated
        $post = $this->post->findOrFail($id);
        //update the post
        $post->description = $request->description;

        //check if the will be updated
        if($request->image)
        {
            //if yes update
            $post->image = 'data:image/'. $request->image->extension().
            ';base64,' . base64_encode(file_get_contents($request->image));
        }


         //save to db
        $post->save();

        //update the selected categories,but first delete all previously selected
        $post->categoryPost()->delete();

        //save the new categories selected to category post
        $category_post = [];
        foreach($request->category as $category_id){
            $category_post[] = ['category_id' =>$category_id];
        }
       $post->categoryPost()->createMany($category_post);

        //return to post show
        return redirect()->route('post.show',$id);

    }

    public function destroy($id){

        $post = $this->post->findOrFail($id);
        $post->forceDelete();
        $this->post->categoryPost()->delete();

        return redirect()->route('index');
    }

}
