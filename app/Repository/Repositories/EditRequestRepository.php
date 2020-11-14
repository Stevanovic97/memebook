<?php
namespace App\Repository\Repositories;

use App\EditRequest;
use App\Http\Requests\EditRequestReq;
use App\Repository\IRepositories\EditRequestIRepository;

class EditRequestRepository implements EditRequestIRepository
{
    protected $model;

    public function __construct(EditRequest $model)
    {
        $this->model = $model;
    }

    public function getEditRequestsForUser($user_id)
    {
        return $this->model->getAllEditRequestsForUser($user_id);
    }   

    public function getEditRequestsForMeme($meme_id)
    {
        return $this->model->getAllEditRequestsForMeme($meme_id);
    }   

    public function getEditRequest($editRequest_id)
    {
        return $this->model->getEditRequest($editRequest_id);
    }

    public function deleteEditRequest($editRequest_id)
    {
        return $this->model->deleteEditRequest($editRequest_id);
    }

    public function addEditRequest(EditRequestReq $request)
    {
        return $this->model->addEditRequest($request);
    }
}