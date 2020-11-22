<?php

namespace App;

use Auth;
use App\Category;
use App\User;
use App\Comment;
use App\Vote;
use App\MemeReport;
use App\MessageHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class Meme extends Model
{
    protected $fillable = ['title', 'body', 'category_id', 'user_id', 'image'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function votes()
    {
        return $this->hasMany('App\Vote');
    }

    public function reports()
    {
        return $this->hasMany('App\MemeReport');
    }

    public function getAllMemes()
    {
        $memes = Meme::with(['votes', 'user'])->orderBy('created_at', 'desc')->paginate(5);
        if (!empty($memes))
        {
            $memes = $this->fillMemeData($memes);
        }
        return $memes;
    }

    public function getAllMemesForCategory($category_id)
    {
        $memes = Meme::where('category_id', $category_id)->orderBy('created_at', 'desc')->paginate(5);
        if (!empty($memes))
        {
            $memes = $this->fillMemeData($memes);
        }
        return $memes;
    }

    public function getAllMemesForUser($user_id)
    {
        $memes = Meme::where('user_id', $user_id)->orderBy('created_at', 'desc')->paginate(5);
        if (!empty($memes))
        {
            $memes = $this->fillMemeData($memes);
        }
        return $memes;
    }

    public function getMeme($meme_id)
    {
        $meme = Meme::findOrFail($meme_id);
        $this->fillMemeData($meme);

        return $meme;
    }

    public function addMeme(Request $request, $img_name)
    {
        $created = Meme::create([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $img_name,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id
        ]);
        if ($created) {
            return MessageHelper::ToastMessage('success', false, 'CreateMemeSuccess');
        } 
        else {
            return MessageHelper::ToastMessage('danger', false, 'CreateMemeFail');
        }
    }

    public function addApiMeme($data)
    {
        $created = Meme::create([
            'title' => $data->title,
            'body' => $data->body,
            'image' => $data->image,
            'user_id' => Auth::user()->id,
            'category_id' => $data->category_id
        ]);
        if ($created) {
            return MessageHelper::ToastMessage('success', false, 'CreateMemeSuccess');
        } 
        else {
            return MessageHelper::ToastMessage('danger', false, 'CreateMemeFail');
        }
    }

    public function updateMeme(Request $request, $meme_id)
    {
        $meme = Meme::find($meme_id);
        $meme->title = $request->title;
        $meme->body = $request->body;

        $updated = $meme->save();
        if ($updated) {
            return MessageHelper::ToastMessage('success', false, 'UpdateMemeSuccess');
        } 
        else {
            return MessageHelper::ToastMessage('danger', false, 'UpdateMemeFail');
        }
    }

    public function deleteMeme($meme_id)
    {
        $meme = Meme::findOrFail($meme_id);
        $deleted = $meme->delete();
        if ($deleted) {
            return MessageHelper::ToastMessage('success', false, 'DeleteMemeSuccess');
        } 
        else {
            return MessageHelper::ToastMessage('danger', false, 'DeleteMemeFail');
        }
    }

    private function fillMemeData($memes)
    {
        $auth_user = Auth::user();
        if ($memes instanceof LengthAwarePaginator)
        {
            foreach ($memes as $meme)
            {
                $meme->sourceImage = $this->checkImageSource($meme);
                $meme->username = $meme->user->name;
                $vote = $meme->votes->first(function($vote) {
                    return Auth::user() ? $vote->user_id === Auth::user()->id : null;
                });
                $meme->numOfVotes = $meme->votes->sum('vote');
                $meme->voted = $auth_user ? $this->memeIsVotedByUser($vote)
                                            : array('upvoted' => 'white', 'downvoted' => 'white');
            };
        }
        else
        {
            $memes->sourceImage = $this->checkImageSource($memes);
            $memes->username = $memes->user->name;
            $vote = $memes->votes->first(function($vote) {
                return Auth::user() ? $vote->user_id === Auth::user()->id : null;
            });
            $memes->numOfVotes = $memes->votes->sum('vote');
            $memes->voted = $auth_user ? $this->memeIsVotedByUser($vote)
                                        : array('upvoted' => 'white', 'downvoted' => 'white');
        }
        return $memes;
    }

    private function checkImageSource($meme)
    {
        return strpos($meme->image, "imgflip") !== false ? $meme->image
                                                         : URL::to('/') . '/images/memes/' .  $meme->image;
    }

    private function memeIsVotedByUser($meme_vote)
    {
        if ($meme_vote === null) 
        {
            return array('upvoted' => 'white', 'downvoted' => 'white'); 
        }
        return $meme_vote->vote === 1 ? array('upvoted' => '#99CCFF', 'downvoted' => 'white')
                                      : array('upvoted' => 'white', 'downvoted' => '#99CCFF');
    }
}
