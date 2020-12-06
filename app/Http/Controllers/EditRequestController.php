<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request\EditRequestReq;

class EditRequestController extends MemeBookBaseController
{
    public function indexForUser($user_id)
    {
        $editRequests = $this->repository->getEditRequestsForUser($user_id);
        return view('meme.editrequests', $editRequests);
    }

    public function indexForMeme($meme_id)
    {
        $editRequests = $this->repository->getEditRequestsForMeme($meme_id);
        return view('meme.editrequests', $editRequests);
    }

    public function store(EditRequestReq $request)
    {
        try
        {
            $validated = $request->validated();
            $created = $this->repository->addEditRequest($validated);
        }
        catch (Exception $exception)
        {
            echo 'Error while trying to request meme edit: ', $exception->getMessage(), "\n";
        }
    }

    public function show($edit_request_id)
    {
        try
        {
            $editRequest = $this->repository->getEditRequest($edit_request_id);
            return view('meme.editrequest', $editRequest);
        }
        catch (Exception $exception)
        {
            echo 'Error while trying to get meme edit requests: ', $exception->getMessage(), "\n";
        }
    }

    public function destroy($edit_request_id)
    {
        try
        {
            $deleted = $this->repository->deleteEditRequest($edit_request_id);
        }
        catch (Exception $exception)
        {
            echo 'Error while trying to delete edit meme request: ', $exception->getMessage(), "\n";
        }
    }
}
