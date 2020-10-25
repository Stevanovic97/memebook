<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request\EditRequestReq;

class EditRequestController extends Controller
{
    private $repository;

    public function __construct(CommentIRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource for user.
     *
     * @param int user_id
     * @return \Illuminate\Http\Response
     */
    public function indexForUser($user_id)
    {
        $editRequests = $this->repository->getEditRequestsForUser($user_id);
        return view('meme.editrequests', $editRequests);
    }

    /**
     * Display a listing of the resource for meme.
     *
     * @param int meme_id
     * @return \Illuminate\Http\Response
     */
    public function indexForMeme($meme_id)
    {
        $editRequests = $this->repository->getEditRequestsForMeme($meme_id);
        return view('meme.editrequests', $editRequests);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\EditRequestReq  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $edit_request_id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $edit_request_id
     * @return \Illuminate\Http\Response
     */
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
