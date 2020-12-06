<?php
namespace App\Repository\Repositories;

use App\Repository\IRepositories\VoteIRepository;
use App\Vote;

class VoteRepository implements VoteIRepository
{
    protected $model;

    public function __construct(Vote $model)
    {
        $this->model = $model;
    }

    function getAllMemeVotes($meme_id, $user_id)
    {
        return $this->model->getAllMemeVotes($meme_id, $user_id);
    }

    function getMemeVotesSum($meme_id)
    {
        return $this->model->getMemeVoteSum($meme_id);
    }

    function voteMeme($meme_id, $user_id, $vote)
    {
        return $this->model->voteMeme($meme_id, $user_id, $vote);
    }

    function votedMemeByUser($meme_id, $user_id)
    {
        return $this->model->memeIsVotedByUser($meme_id, $user_id);
    }

    function deleteAllVotesForMeme($meme_id)
    {
        return $this->model->deleteAllVotesForMeme($meme_id);
    }
}