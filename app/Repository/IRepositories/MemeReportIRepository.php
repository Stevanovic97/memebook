<?php
namespace App\Repository\IRepositories;

use Illuminate\Http\Request;

interface MemeReportIRepository
{
    function getMemeReportsForUser($user_id);
    function getMemeReports($meme_id);
    function addMemeReport(Request $request, $user_id);
    function deleteMemeReportsForUser($user_id);
    function deleteMemeReports($meme_id);
}
