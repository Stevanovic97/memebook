<?php

namespace App\Http\Controllers;

use App\User;
use App\MemeBookConstants;
use App\Events\NewNotification;
use App\Notifications\UserFollowed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\NotificationRequest;

class UserController extends MemeBookBaseController
{
    public function show($user_id)
    {
        if (isset($user_id))
        {
            try
            {
                $user = $this->userRepository->getUser($user_id);
                $categories = $this->categoryRepository->getCategories();
                $memes = $this->memeRepository->getAllMemesForUser($user_id);
        
                return view('User.show')->with(compact('user', 'memes', 'categories'));
            }
            catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
            {
                $message = MessageHelper::ToastMessage('danger', false, 'NotFound');
                return back()->with($message);
            }
        }
        else
        {
            $message = MessageHelper::ToastMessage('danger', false, 'NotFound');
            return back()->with($message);
        }
    }

    public function follow(Request $request)
    {
        if (isset($request->user_id))
        {
            $follower = auth()->user();
            if (!$follower->isFollowing($request->user_id))
            {
                $message = $follower->follow($request->user_id);
                $followed_user = $this->userRepository->getUser($request->user_id);
                $followed_user->notify(new UserFollowed($follower));
                $typeOfNotification = MemeBookConstants::$notificationConstants['followUser'];
                event(new NewNotification($followed_user, null, $typeOfNotification));
                
                return back()->with($message);
            }
        }
        else
        {
            $message = MessageHelper::ToastMessage('danger', false, 'NotFound');
            return back()->with($message);
        }
    }
    
    public function unfollow(Request $request)
    {
        if (isset($request->user_id))
        {
            $follower = auth()->user();
            if ($follower->isFollowing($request->user_id)) 
            {
                $message = $follower->unfollow($request->user_id);
                return back()->with($message);
            }
        }
        else
        {
            $message = MessageHelper::ToastMessage('danger', false, 'NotFound');
            return back()->with($message);
        }
    }

    public function isFollowing(Request $request)
    {
        if (isset($request->user_id))
        {
            $user_id = $request->user_id;
            $isFollowing = auth()->user()->isFollowing($user_id);

            return json_encode($isFollowing);
        }
        else
        {
            return response()->json(['error' => 'User not found.'], 404); 
        }
    }

    public function notifications()
    {
        return $this->userRepository->getNotifications();
    }

    public function readNotification(Request $request)
    {
        $validator = Validator::make($request->all(), NotificationRequest::rules());
        if ($validator->fails()) {
            $message = MessageHelper::ToastMessage('danger', true, $validator->messages()
                                                                             ->first());
            return response()->json($message, Response::HTTP_BAD_REQUEST);
        }

        $urlFromNotification = $this->userRepository->markNotificationAsRead($request->notificationId);
        return $urlFromNotification;
    }
}
