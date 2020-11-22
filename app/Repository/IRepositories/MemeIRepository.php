<?php

namespace App\Repository\IRepositories;

use Illuminate\Http\Request;

interface MemeIRepository
{
    function getAllMemes();

    function getAllMemesForCategory($category_id);

    function getAllMemesForUser($user_id);

    function getMeme($meme_id);

    function deleteMeme($meme_id);

    function addMeme(Request $request, $img_name);

    function addApiMeme($data);

    function updateMeme(Request $request, $meme_id);
}
