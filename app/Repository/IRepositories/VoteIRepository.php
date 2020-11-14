<?php
namespace App\Repository\IRepositories;

interface VoteIRepository
{
    function getAllMemeVotes($meme_id, $user_id);
    function getMemeVotesSum($meme_id);
    function voteMeme($meme_id, $user_id, $vote);
    function deleteAllVotesForMeme($meme_id);
}
