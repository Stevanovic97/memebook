<?php
namespace App\Repository\IRepositories;

use App\Comment;
use App\Meme;

interface CommentIRepository
{
    function getComments($meme_id);
    function getComment($category_id);
    function deleteComment($category_id);
    function addComment(CommentRequest $request);
    function updateComment(CommentRequest $request, $comment_id);
}