<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class CommentController extends Controller
{
	public function store(Request $request, $post)
	{
		$request->validate([
            'message' => 'required',
			'name' => 'required_if:email,null',
			'email' => 'required_if:name,null|email'
        ]);

        // Check if the user is authenticated
        if (Auth::check()) {
            // If the user is authenticated, get their ID
            $userId = Auth::user()->id;
            $userName = Auth::user()->name;
            $userEmail = Auth::user()->email;
        } else {
            // If the user is not authenticated, get the name and email from the request
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
            ]);

            $userName = $request->name;
            $userEmail = $request->email;
            $userId = null; 
        }

        // Create a new comment
        $comment = new Comment();
        $comment->user_id = $userId;
        $comment->post_id = $post;
        $comment->name = $userName;
        $comment->email = $userEmail;
        $comment->message = $request->message;
        $comment->save();

        Toastr::success('Your comment was successfully submitted');

        return redirect()->back();
    
	}
    public function reply(Request $request, $commentId)
{
    $request->validate([
        'reply_message' => 'required',
    ]);

    $reply = new Reply();
    $reply->user_id = Auth::id(); // Get the authenticated user's ID
    $reply->comment_id = $commentId;
    $reply->message = $request->reply_message;
    $reply->save();

    Toastr::success('Your reply was successfully submitted');

    return redirect()->back();
}
public function like($commentid)
{
    $user = Auth::user(); 

    if (!$user) {
        Toastr::info('To add like, you need to log in first!', '', ['progressBar' => true]);
        return redirect()->back();
    }

    $comment=Comment::findorfail($commentid);

    $isFavorite = $user->liked_comments()->where('comment_id', $comment->id)->count();

    if ($isFavorite == 0) {
        $user->liked_comments()->attach($comment);
        Toastr::success('You successfully added to your favorite list');
    } else {
        $user->liked_comments()->detach($comment);
        Toastr::success('You successfully removed from your favorite list');
    }

    return redirect()->back();
}
public function destroy($commentid){
    $comment=Comment::findorfail($commentid);
    if($comment->user_id != Auth::id()){
        Toastr::error('You are not authorized to delete this comment', '', ['progressBar' => true]);}
        $comment->delete();
        Toastr::success('Comment deleted successfully.', '', ['progressBar' => true]);
        return redirect()->back()->with('success', 'Comment deleted successfully.');

}

}
