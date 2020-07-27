<?php
namespace App\Repository\IRepositories;

use App\Meme;
use App\EditRequest;

interface EditRequestIRepository
{
    public function getEditRequestsForUser($user_id);
    public function getEditRequestsForMeme($meme_id);
    public function getEditRequest($editRequest_id);
    public function deleteEditRequest($editRequest_id);
    public function addEditRequest(EditRequestReq $request);
}