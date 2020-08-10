<?php
namespace App\Repository\IRepositories;

use App\Http\Requests\CommentRequest;

interface CommentIRepository
{
    function getComments($meme_id);
    function getComment($comment_id);
    function deleteComment($comment_id);
    function addComment(CommentRequest $request);
    function updateComment(CommentRequest $request, $comment_id);
}