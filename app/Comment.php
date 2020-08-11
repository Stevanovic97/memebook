<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment_text'];

    public function Meme()
    {
        return $this->belongsTo('App\Meme');
    }

    public function User()
    {
        return $this->belongsTo('App\Users');
    }

    public function getAllMemeComments($meme_id)
    {
        return Comment::where('meme_id', $meme_id)->get();
    }

    public function getMemeComment($comment_id)
    {
        return Comment::where('id', $comment_id)->get();
    }

    public function deleteMemeComment($comment_id)
    {
        Comment::where('id', $comment_id)->delete();
    }

    public function addMemeComment(CommentRequest $request)
    {
        Comment::create([
            'comment_text' => $request->commentText,
            'meme_id' => $request->memeId,
            'user_id' => Auth::id(),
        ]);
    }

    public function updateMemeComment(CommentRequest $request, $comment_id)
    {
        $comment = Comment::find($comment_id);
        if (strcmp($comment->comment_text, $request->commentText) == 0)
        {
            $comment->comment_text = $request->commentText;
            $comment->save();
            return true;
        }
        else
            return false;
    } 
}
