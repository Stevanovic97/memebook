<?php

namespace App\Http\Controllers;

use App\User;
use App\MemeBookConstants;
use App\Events\NewNotification;
use App\Notifications\UserFollowed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends MemeBookBaseController
{
    public function show($user_id)
    {
        $user = $this->userRepository->getUser($user_id);
        $user->following = $user->follows()->count();
        $user->followers = $user->followers()->count();
        $categories = $this->categoryRepository->getCategories();
        $allUserMemes = $this->memeRepository->getAllMemesForUser($user_id);
        $memes = $this->fillMemeData($allUserMemes);

        return view('User.show')->with(compact('user', 'memes', 'categories'));
    }

    public function follow(Request $request)
    {
        $follower = auth()->user();
        if (!$follower->isFollowing($request->user_id))
        {
            $message = $follower->follow($request->user_id);
            $followed_user = $this->userRepository->getUser($request->user_id);
            $followed_user->notify(new UserFollowed($follower));
            event(new NewNotification($followed_user, NULL, MemeBookConstants::$notificationConstants['followUser']));
            
            return back()->with($message);
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

    public function notifications()
    {
        return $this->userRepository->getNotifications();
    }

    public function readNotification(Request $request)
    {
        if ($request->getContent())
        {
            $urlFromNotification = $this->userRepository->markNotificationAsRead($request->getContent());
            return $urlFromNotification;
        }
    }
}
