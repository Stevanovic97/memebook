<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request\CommentRequest;
use App\Repository\IRepositories\CommentIRepository;
use App\Comment;

class CommentController extends Controller
{
    private $repository;

    public function __construct(CommentIRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param int @meme_id
     * @return \Illuminate\Http\Response
     */
    public function index($meme_id)
    {
        try
        {
            $comments = $this->repository->getComments($meme_id);
            return view('meme.comments', $comments);
        }
        catch (Exception $exception)
        {
            echo 'Error while trying to get meme comments: ', $exception->getMessage(), "\n";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $comment_id
     * @return \Illuminate\Http\Response
     */
    public function show($comment_id)
    {
        try
        {
            $comment = $this->repository->getComment($comment_id);
            return view('meme.comment', $comment);
        }
        catch (Exception $exception)
        {
            echo 'Error while trying to get meme comments: ', $exception->getMessage(), "\n";
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('meme.comment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        try
        {
            $validated = $request->validated();
            $this->repository->addComment($validated);
            Session::flash('alert-success', 'success');
        }
        catch (Exception $exception)
        {
            echo 'Error while trying to add meme comment: ', $e->getMessage(), "\n";
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $comment_id
     * @return \Illuminate\Http\Response
     */
    public function edit($comment_id)
    {
        return view('meme.comment.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\CommentRequest  $request
     * @param  int  $comment_id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, $comment_id)
    {
        try
        {
            $validated = $request->validated();
            if ($this->repository->updateComment($validated, $comment_id))
            {
                Session::flash('alert-success', 'success');
            }
            else
            {
                Session::flash('alert-warning', 'warning');
            }
        }
        catch (Exception $exception)
        {
            echo 'Error while trying to update meme: ', $e->getMessage(), "\n";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $comment_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($comment_id)
    {
        try
        {
            $this->repository->deleteComment($comment_id);
            Session::flash('alert-success', 'success');
        }
        catch (Exception $exception)
        {
            echo 'Error while trying to delete comment: ', $exception->getMessage(), "\n";
        }
    }
}
