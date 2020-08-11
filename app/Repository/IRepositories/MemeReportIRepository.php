<?php
namespace App\Repository\IRepositories;

use App\Http\Requests\MemeReportRequest;

interface MemeReportIRepository
{
    function getMemeReportsForUser($user_id);
    function getMemeReports($meme_id);
    function addMemeReport(MemeReportRequest $request);
    function deleteMemeReportsForUser($user_id);
    function deleteMemeReports($meme_id);
}