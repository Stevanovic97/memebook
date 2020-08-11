<?php
namespace App\Repository\Repositories;

use App\Repository\IRepositories\CommentIRepository;
use App\Http\Requests\CommentRequest;
use App\Comment;

class CommentRepository implements CommentIRepository
{
    protected $model;

    public function __construct(Comment $model)
    {
        $this->model = $model;
    }

    public function getComments($meme_id)
    {
        return $this->model->getAllMemeComments($meme_id);
    }   

    public function getComment($comment_id)
    {
        return $this->model->getMemeComment($comment_id);
    }

    public function deleteComment($comment_id)
    {
        $this->model->deleteMemeComment($comment_id);
    }

    public function addComment(CommentRequest $request)
    {
        $this->model->addMemeComment($request);
    }

    public function updateComment(CommentRequest $request, $comment_id)
    {
        $this->model->updateMemeComment($request, $comment_id);
    }
}