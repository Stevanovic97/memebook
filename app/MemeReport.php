<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemeReport extends Model
{
    protected $fillable = ['reason', 'explanation', 'meme_id', 'user_id'];

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

    public function addMemeReport($request, $user_id)
    {
        $report = MemeReport::where('meme_id', '=', $request->meme_id)
                            ->where('user_id', '=', $user_id)->first();
        if ($report === null)
        {
            $created = MemeReport::create([
                'reason' => $request->reason,
                'explanation' => $request->explanation,
                'meme_id' => $request->meme_id,
                'user_id' => $user_id
            ]);
            if ($created) {
                return MessageHelper::Success('MemeReportSuccess');
            }
            else {
                return MessageHelper::Danger('MemeReportFail');
            }
        }
        else
        {
            return MessageHelper::Warning('You have already reported this meme!');
        }
    }

    public function deleteMemeReportsForUser($user_id)
    {
        $deleted = EditRequest::where('user_id', $user_id)->delete();
        if ($deleted) {
            return MessageHelper::Success();
        }
        else {
            return MessageHelper::Danger();
        }
    }

    public function deleteMemeReports($meme_id)
    {
        $deleted = EditRequest::where('meme_id', $meme_id)->delete();
        if ($deleted) {
            return MessageHelper::Success();
        }
        else {
            return MessageHelper::Danger();
        }
    }
}
