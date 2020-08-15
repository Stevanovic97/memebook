<?php

namespace App\Repository\IRepositories;

use App\Http\Requests\MemeRequest;

interface MemeIRepository
{
    function getAllMemes();

    function getAllMemesForCategory($category_id);

    function getAllMemesForUser($user_id);

    function getMeme($meme_id);

    function deleteMeme($meme_id);

    function addMeme(MemeRequest $request, $img_name);

    function updateMeme(MemeRequest $request, $meme_id);
}
