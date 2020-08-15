<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemeReport extends Model
{
    protected $fillable = ['reason', 'explanation'];

    public function meme()
    {
        return $this->belongsTo('App\Meme');
    }

    public function getAllMemeReportsForUser($user_id)
    {
        return MemeReport::where('user_id', $user_id)->get();
    }

    public function getAllMemeReports($meme_id)
    {
        return MemeReport::where('meme_id', $meme_id)->get();
    }

    public function addMemeReport($request)
    {
        $created = MemeReport::create([
            'reason' => $request->reason,
            'explanation' => $request->explanation,
            'meme_id' => $request->meme_id,
            'user_id' => $request->user_id
        ]);
        if ($created) {
            return MessageHelper::ToastMessage('Success');
        } 
        else {
            return MessageHelper::ToastMessage('Error');
        }
    }

    public function deleteMemeReportsForUser($user_id)
    {
        $deleted = EditRequest::where('user_id', $user_id)->delete();
        if ($deleted) {
            return MessageHelper::ToastMessage('Success');
        } 
        else {
            return MessageHelper::ToastMessage('Error');
        }
    }

    public function deleteMemeReports($meme_id)
    {
        $deleted = EditRequest::where('meme_id', $meme_id)->delete();
        if ($deleted) {
            return MessageHelper::ToastMessage('Success');
        } 
        else {
            return MessageHelper::ToastMessage('Error');
        }
    }
}
