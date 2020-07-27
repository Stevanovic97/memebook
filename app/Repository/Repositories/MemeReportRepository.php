<?php
namespace App\Repository\Repositories;

class EditRequestRepository implements EditRequestIRepository
{
    protected $model;

    public function __construct(EditRequest $model)
    {
        $this->model = $model;
    }

    public function getMemeReportsForUser($user_id)
    {
        return $this->model->getAllMemeReportsForUser($user_id);
    }   

    public function getMemeReports($meme_id)
    {
        return $this->model->getAllMemeReports($meme_id);
    }   

    public function addMemeReport(MemeReportRequest $request)
    {
        return $this->model->addMemeReport($request);
    }

    public function deleteMemeReportsForUser($user_id)
    {
        return $this->model->deleteAllMemeReportsForUser($user_id);
    }

    public function deleteMemeReports($meme_id)
    {
        return $this->model->deleteAllMemeReports($meme_id);
    }
}