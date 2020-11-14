<?php

namespace App\Http\Controllers;

use App\User;
use App\MemeBookConstants;
use App\Events\NewNotification;
use App\Notifications\UserFollowed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class UserController extends MemeBookBaseController
{
    public function show($user_id)
    {
        $user = $this->userRepository->getUser($user_id);
        $memes = $this->memeRepository->getAllMemesForUser($user_id);
        $categories = $this->categoryRepository->getCategories();
        $voted = array();
        foreach ($memes as $meme)
        {
            $meme->votes = $this->voteRepository->getMemeVotesSum($meme->id);
            $meme->username = $this->userRepository->getUser($meme->user_id)->name;
            $meme->voted = Auth::user() ? $this->voteRepository->votedMemeByUser($meme->id, Auth::user()->id) :
                                          array('upvoted' => 'white', 'downvoted' => 'white');
        }
        $voted = array_values($voted);

        return view('User.show')->with(compact('user', 'memes', 'categories'));
    }

    public function follow(Request $request)
    {
        $follower = auth()->user();
        if (!$follower->isFollowing($request->user_id))
        {
            $message = $follower->follow($request->user_id);
            $followed_user = $this->userRepository->getUser($request->user_id);
            //db-insert
            $followed_user->notify(new UserFollowed($follower));
            //pusher notification
            event(new NewNotification($followed_user, MemeBookConstants::$notificationConstants['followUser']));
            $notification_id = $follower->getNotification($request->user_id)->id;
            return back()->with(compact('message', 'notification_id'));
        }
    }
    
    public function unfollow(Request $request)
    {
        $follower = auth()->user();
        if ($follower->isFollowing($request->user_id)) 
        {
            $message = $follower->unfollow($request->user_id);
            return back()->with($message);
        }
    }

    public function isFollowing(Request $request)
    {
        $user_id = $request->user_id;
        $isFollowing = auth()->user()->isFollowing($user_id);
        return json_encode($isFollowing);
    }

    public function notification()
    {
        return $this->userRepository->getNotifications();
    }

    public function readNotification(Request $request)
    {
        if ($request->getContent())
        {
            $followerId = $this->userRepository->markNotificationAsRead($request->getContent());
            return $followerId;
        }
    }
}
