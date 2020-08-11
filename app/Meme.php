<?php

namespace App;

use App\Category;
use Auth;
use App\Http\Requests\MemeRequest;
use Illuminate\Database\Eloquent\Model;

class Meme extends Model
{
    protected $fillable = ['title', 'body', 'category_id', 'user_id', 'image'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function getAllMemes()
    {
        return Meme::all();
    }

    public function getAllMemesForUser($user_id)
    {
        return Meme::where('user_id', $user_id)->get();
    }

    public function getMeme($meme_id)
    {
        return Meme::where('id', $meme_id)->get();
    }

    public function deleteMeme($meme_id)
    {
        Meme::where('id', $meme_id)->delete();
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
            $message = [
                'flashType' => 'success',
                'flashMessage' => 'Meme successfully uploaded!'
            ];
            return $message;
        } else {
            $message = [
                'flashType' => 'danger',
                'flashMessage' => 'Upload failed! Please try again.'
            ];
            return $message;
        }
    }

    public function updateMeme(MemeRequest $request, $meme_id)
    {
        $meme = Meme::find($meme_id);
        $meme->title = $request->title;
        $meme->body = $request->body;
        $meme->save();
    }
}
