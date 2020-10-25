<?php

namespace App\Http\Controllers;

use App\Repository\IRepositories\UserIRepository;
use Illuminate\Http\Request;
use App\User;
use App\Notifications\UserFollowed;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserIRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function show($user_id)
    {
        $user = $this->userRepository->getUser($user_id);
        return view('User.showUser')->with(compact('user'));
    }

    public function follow(User $user)
    {
        $follower = auth()->user();
        if(!$follower->isFollowing($user->id)) {
            $follower->follow($user->id);

            // sending a notification
            $user->notify(new UserFollowed($follower));

            return back()->withSuccess("You are now friends with {$user->name}");
        }
        return back()->withError("You are already following {$user->name}");
    }

    public function unfollow(User $user)
    {
        $follower = auth()->user();
        if($follower->isFollowing($user->id)) {
            $follower->unfollow($user->id);
            return back()->withSuccess("You are no longer friends with {$user->name}");
        }
        return back()->withError("You are not following {$user->name}");
    }

    public function notification()
    {
        //dd('upada');
        return auth()->user()->unreadNotifications()->limit(5)->get()->toArray();
    }

    public function readNotification($notificationId)
    {
        //$notification=auth()->
    }
}
