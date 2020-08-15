<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EditRequest extends Model
{
    protected $guarded = [];
    
    public function meme()
    {
        return $this->belongsTo('App\Meme');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getAllEditRequestsForUser($user_id)
    {
        return EditRequest::where('user_id', $user_id)->get();
    }

    public function getAllEditRequestsForMeme($meme_id)
    {
        return EditRequest::where('meme_id', $meme_id)->get();
    }

    public function getEditRequest($editRequest_id)
    {
        return EditRequest::where('id', $editRequest_id)->get();
    }

    public function deleteEditRequest($editRequest_id)
    {
        $deleted = EditRequest::where('id', $editRequest_id)->delete();
        if ($deleted) {
            return MessageHelper::ToastMessage('Success');
        } 
        else {
            return MessageHelper::ToastMessage('Error');
        }
    }

    public function addEditRequest(EditRequestReq $request)
    {
        $created = EditRequest::create([
            'request_by_user_id' => Auth::id(),
            'request_to_user_id' => $request->user_id,
            'meme_id' => $request->meme_id,
        ]);
        if ($created) {
            return MessageHelper::ToastMessage('Success');
        } 
        else {
            return MessageHelper::ToastMessage('Error');
        }
    }
}
