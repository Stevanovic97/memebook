<?php
namespace App\Repository\Repositories;

use App\MemeReport;
use App\Http\Requests\MemeReportRequest;
use App\Repository\IRepositories\MemeReportIRepository;
use Illuminate\Http\Request;

class MemeReportRepository implements MemeReportIRepository
{
    protected $model;

    public function __construct(MemeReport $model)
    {
        $this->model = $model;
    }

    public function addMemeReport(Request $request, $user_id)
    {
        return $this->model->addMemeReport($request, $user_id);
    }

    public function getMemeReportsForUser($user_id)
    {
        return $this->model->getAllMemeReportsForUser($user_id);
    }

    public function getMemeReports($meme_id)
    {
        return $this->model->getAllMemeReports($meme_id);
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
