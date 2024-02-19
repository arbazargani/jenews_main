<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function Submit(Request $request, $id)
    {
        $comment = new Comment;
        $comment->content = $request['content'];
        $comment->article_id = $id;
        $comment->approved = 0;
        if (Auth::check()) {
            $request->validate([
                'content' => 'required|min:2',
            ]);
            $comment->user_id = Auth::user()->id;
            $comment->name = Auth::user()->name;
            $comment->family = Auth::user()->family;
            $comment->email = Auth::user()->email;
            $comment->approved = 1;
        } else {
            $request->validate([
                'name' => 'min:3',
                'family' => 'min:3',
                'email' => 'required|min:5',
                'website' => 'min:4',
                'content' => 'required|min:5'
            ]);
            $comment->name = $request['name'];
            $comment->family = $request['family'];
            $comment->email = $request['email'];
        }
        if (isset($request['website'])) {
            $comment->website = $request['website'];
        }
        $comment->save();
        return back();
    }

    public function Manage()
    {
        $comments = Comment::latest()->paginate(15);
        return view('admin.comment.manage', compact('comments'));
    }

    public function Approve($id)
    {
        $comment = Comment::find($id);
        if ($comment) {
            $comment->approved = 1;
            $comment->save();
            return back(301);
        } else {
            return abort(401, 'unauthorized action.');
        }
    }

    public function Unapprove($id)
    {
        $comment = Comment::find($id);
        if ($comment) {
            $comment->approved = 0;
            $comment->save();
            return back(301);
        } else {
            return abort(401, 'unauthorized action.');
        }
    }

    public function Delete($id)
    {
        $comment = Comment::find($id);
        if ($comment) {
            $comment->delete();
            return back(301);
        } else {
            return abort(401, 'unauthorized action.');
        }
    }
}
