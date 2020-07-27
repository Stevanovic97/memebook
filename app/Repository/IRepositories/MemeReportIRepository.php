<?php
namespace App\Repository\IRepositories;

use App\Meme;
use App\MemeReport;

interface CommentIRepository
{
    public function getMemeReportsForUser($user_id);
    public function getMemeReports($meme_id);
    public function addMemeReport(MemeReportRequest $request);
    public function deleteMemeReportsForUser($user_id);
    public function deleteMemeReports($meme_id);
}