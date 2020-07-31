<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meme extends Model
{
    protected $fillable = ['title', 'body', 'category_id', 'user_id', 'image'];
}
