<?php

namespace App;

use Auth;
use App\Category;
use App\User;
use App\Comment;
use App\MessageHelper;
use App\Http\Requests\MemeRequest;
use Illuminate\Database\Eloquent\Model;

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

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function getAllMemes()
    {
        return Meme::orderBy('created_at', 'desc')->paginate(5);
    }

    public function getAllMemesForCategory($category_id)
    {
        return Meme::where('category_id', $category_id)->orderBy('created_at', 'desc')->paginate(5);
    }

    public function getAllMemesForUser($user_id)
    {
        return Meme::where('user_id', $user_id)->orderBy('created_at', 'desc')->paginate(5);
    }

    public function getMeme($meme_id)
    {
        return Meme::where('id', $meme_id)->first();
    }

    public function deleteMeme($meme_id)
    {
        $deleted = Meme::where('id', $meme_id)->delete();
        if ($deleted) {
            return MessageHelper::ToastMessage('Success');
        } 
        else {
            return MessageHelper::ToastMessage('Error');
        }
    }

    public function addMeme(MemeRequest $request, $img_name)
    {
        $created = Meme::create([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $img_name,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id
        ]);
        if ($created) {
            return MessageHelper::ToastMessage('Success');
        } 
        else {
            return MessageHelper::ToastMessage('Error');
        }
    }

    public function updateMeme(MemeRequest $request, $meme_id)
    {
        $meme = Meme::find($meme_id);
        $meme->title = $request->title;
        $meme->body = $request->body;

        $updated = $meme->save();
        if ($updated) {
            return MessageHelper::ToastMessage('Success');
        } 
        else {
            return MessageHelper::ToastMessage('Error');
        }
    }
}
