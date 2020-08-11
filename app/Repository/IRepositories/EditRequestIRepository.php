<?php
namespace App\Repository\IRepositories;

use App\Http\Requests\EditRequestReq;

interface EditRequestIRepository
{
    function getEditRequestsForUser($user_id);
    function getEditRequestsForMeme($meme_id);
    function getEditRequest($editRequest_id);
    function deleteEditRequest($editRequest_id);
    function addEditRequest(EditRequestReq $request);
}