<?php

namespace App\Repository\Repositories;

use App\Meme;
use App\Http\Requests\MemeRequest;
use App\Repository\IRepositories\MemeIRepository;

class MemeRepository implements MemeIRepository
{
    protected $model;

    public function __construct(Meme $model)
    {
        $this->model = $model;
    }

    public function getAllMemes()
    {
        return $this->model->getAllMemes();
    }

    public function getAllMemesForCategory($category_id)
    {
        return $this->model->getAllMemesForCategory($category_id);
    }

    public function getAllMemesForUser($user_id)
    {
        return $this->model->getAllMemesForUser($user_id);
    }

    public function getMeme($meme_id)
    {
        return $this->model->getMeme($meme_id);
    }

    public function deleteMeme($meme_id)
    {
        return $this->model->deleteMeme($meme_id);
    }

    public function addMeme(MemeRequest $request, $img_name)
    {
        return $this->model->addMeme($request, $img_name);
    }

    public function updateMeme(MemeRequest $request, $meme_id)
    {
        return $this->model->updateMeme($request, $meme_id);
    }
}
