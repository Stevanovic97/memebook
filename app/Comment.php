<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment_text'];

    public function meme()
    {
        return $this->belongsTo('App\Meme');
    }

    public function user()
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
        $deleted = Comment::where('id', $comment_id)->delete();
        if ($deleted) {
            return MessageHelper::ToastMessage('Success');
        } 
        else {
            return MessageHelper::ToastMessage('Error');
        }
    }

    public function addMemeComment(CommentRequest $request)
    {
        $created = Comment::create([
            'comment_text' => $request->commentText,
            'meme_id' => $request->memeId,
            'user_id' => Auth::id(),
        ]);
        if ($created) {
            return MessageHelper::ToastMessage('Success');
        } 
        else {
            return MessageHelper::ToastMessage('Error');
        }
    }

    public function updateMemeComment(CommentRequest $request, $comment_id)
    {
        $comment = Comment::find($comment_id);
        if (strcmp($comment->comment_text, $request->commentText) == 0)
        {
            $comment->comment_text = $request->commentText;
            $updated = $comment->save();
        }
        if (isset($updated))
        {
            if ($updated) {
                return MessageHelper::ToastMessage('Success');
            }
            else {
                return MessageHelper::ToastMessage('Error');
            }
        }
    } 
}
