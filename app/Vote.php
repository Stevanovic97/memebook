<?php

namespace App;

use DB;
use App\Meme;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
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

    public function getAllMemeVotes($meme_id, $user_id)
    {
        return Vote::where('meme_id', '=', $meme_id)->where('user_id', '=', $user_id)->get();
    }
    
    public function voteMeme($meme_id, $user_id, $vote)
    {
        $meme_vote = Vote::where('meme_id', '=', $meme_id)->where('user_id', '=', $user_id)->first();
        if ($meme_vote === null)
        {
            Vote::create([
                'meme_id' => $meme_id,
                'user_id' => $user_id,
                'vote' => $vote
            ]);
            return $this->generateVoteResponse($this->getMemeVoteSum($meme_id), 'created', $meme_id);
        }
        else
        {
            if ($meme_vote->vote == $vote)
            {
                Vote::where('meme_id', '=', $meme_id)->where('user_id', '=', $user_id)->delete();
                return $this->generateVoteResponse($this->getMemeVoteSum($meme_id), 'deleted', $meme_id);
            }
            else
            {
                Vote::where('meme_id', '=', $meme_id)->where('user_id', $user_id)->update(['vote' => $vote]);
                return $this->generateVoteResponse($this->getMemeVoteSum($meme_id), 'updated', $meme_id);
            }
        }
    }

    public function getMemeVoteSum($meme_id)
    {
        return Vote::where('meme_id', $meme_id)->sum('vote');
    }

    public function generateVoteResponse($sum, $type, $meme_id)
    {
        $voteResponse = ['sum' => $sum, 'type' => $type, 'meme_id' => $meme_id];
        return $voteResponse;
    }

    public function memeIsVotedByUser($meme_id, $user_id)
    {
        $meme_vote = Vote::where('meme_id', '=', $meme_id)->where('user_id', '=', $user_id)->first();
        if ($meme_vote === null) 
        {
            return array('upvoted' => 'white', 'downvoted' => 'white'); 
        }
        return $meme_vote->vote === 1 ? array('upvoted' => '#99CCFF', 'downvoted' => 'white')
                                      : array('upvoted' => 'white', 'downvoted' => '#99CCFF');
    }

    public function deleteAllVotesForMeme($meme_id)
    {
        $meme = Meme::find($meme_id);
        if ($meme != null)
        {
            Vote::where('meme_id', '=', $meme_id)->delete();
            return MessageHelper::ToastMessage('success');
        }
        else
        {
            return MessageHelper::ToastMessage('danger');
        }
    }
}