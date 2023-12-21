<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //

    private $comment;
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function store(Request $request,$post_id)
    {
        //form validate
        $request->validate(
            ['comment_body' .$post_id => 'required|max:150'],
            [
                //custom error validation message
                'comment_body' .$post_id . 'required'=> 'Comment should not be empty.',
                'comment_body' .$post_id . 'max'=>'Comment should not be more than 150 characters.'
            ]
            );
            //save the comment
            $this->comment->body = $request->input('comment_body' .$post_id);
            $this->comment->post_id = $post_id;
            $this->comment->user_id = Auth::user()->id;
            $this->comment->save();

            //return back to previous page
            return redirect()->back();
    }


    public function destroy($id){

        $this->comment->destroy($id);

        return redirect()->back();
    }



}
