<?php

namespace App\Http\Controllers;

use App\User;
use App\MessageHelper;
use App\MemeBookConstants;
use App\Events\NewNotification;
use App\Http\Requests\NotificationRequest;
use App\Notifications\UserFollowed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class UserController extends MemeBookBaseController
{
    public function show($user_id)
    {
        if (isset($user_id)) {
            try {
                $user = $this->userRepository->getUser($user_id);
                $categories = $this->categoryRepository->getCategories();
                $memes = $this->memeRepository->getAllMemesForUser($user_id);

                return view('User.show')->with(compact('user', 'memes', 'categories'));
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                $message = MessageHelper::Error('NotFound');
                return back()->with($message);
            }
        } else {
            $message = MessageHelper::Error('NotFound');
            return back()->with($message);
        }
    }

    public function editName()
    {
        return view('user.editName');
    }

    public function updateName(Request $request)
    {
        $user = $this->userRepository->getUserById(auth()->user()->id);
        if (isset($user)) {
            $user->name = $request->name;
            $user->save();
            $memes = $this->memeRepository->getAllMemesForUser($user->id);

            return view('user.show')->with(compact('user', 'memes'));
        } else {
            $message = MessageHelper::Error('No User Found!');
            return back()->with($message);
        }
    }

    public function editPassword()
    {
        return view('user.editPassword');
    }

    public function updatePassword(Request $request)
    {
        $user = $this->userRepository->getUserById(auth()->user()->id);
        if (Hash::check($request->OldPassword, $user->password)) {
            if (isset($request->NewPassword) && isset($request->NewPasswordConfirm)) {
                if ($request->NewPassword == $request->NewPasswordConfirm) {
                    $user->password = Hash::make($request->NewPasswordConfirm);
                    $user->save();

                    $memes = $this->memeRepository->getAllMemesForUser($user->id);
                    return view('user.show')->with(compact('user', 'memes'));
                } else {
                    $message = MessageHelper::Error('Passwords must match!');
                    return back()->with($message);
                }
            } else {
                $message = MessageHelper::Error('Please type and confirm New Password!');
                return back()->with($message);
            }
        } else {
            $message = MessageHelper::Error('Old Password is not correct!');
            return back()->with($message);
        }
    }

    public function follow(Request $request)
    {
        if (isset($request->user_id)) {
            $follower = auth()->user();
            if (!$follower->isFollowing($request->user_id)) {
                $message = $follower->follow($request->user_id);
                $followed_user = $this->userRepository->getUser($request->user_id);
                $followed_user->notify(new UserFollowed($follower));
                $typeOfNotification = MemeBookConstants::$notificationConstants['followUser'];
                event(new NewNotification($followed_user, null, $typeOfNotification));

                return back()->with($message);
            }
        } else {
            $message = MessageHelper::Error('NotFound');
            return back()->with($message);
        }
    }

    public function unfollow(Request $request)
    {
        if (isset($request->user_id)) {
            $follower = auth()->user();
            if ($follower->isFollowing($request->user_id)) {
                $message = $follower->unfollow($request->user_id);
                return back()->with($message);
            }
        } else {
            $message = MessageHelper::Error('NotFound');
            return back()->with($message);
        }
    }

    public function isFollowing(Request $request)
    {
        if (isset($request->user_id)) {
            $user_id = $request->user_id;
            $isFollowing = auth()->user()->isFollowing($user_id);
            \Debugbar($isFollowing);
            return $this->respondWithData($isFollowing);
        } else {
            return $this->respondWithError('User not found.', 404);
        }
    }

    public function showFollowers()
    {
        $user = $this->userRepository->getUser(auth()->user()->id);
        $followers = $user->followers()->get();

        return view('user.followers')->with(compact('followers'));
    }

    public function showFollowing()
    {
        $user = $this->userRepository->getUser(auth()->user()->id);
        $follows = $user->follows()->get();
        return view('user.follows')->with(compact('follows'));
    }

    /**@ Notifications */

    public function notifications()
    {
        $notifications = $this->userRepository->getNotifications();
        return response()->json($notifications);
    }

    public function readNotification(Request $request)
    {
        $validator = Validator::make($request->all(), NotificationRequest::rules());
        if ($validator->fails()) {
            $message = MessageHelper::Error($validator->messages()->first());
            return $this->respondWithError($message, 400);
        }

        $urlFromNotification = $this->userRepository->markNotificationAsRead($request->notificationId);
        return $this->respondWithData($urlFromNotification);
    }

    public function readNotifications(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $read = $this->userRepository->markNotificationsAsRead($user->id);
            return $read ? $this->respondSuccess()
                : $this->respondWithError();
        } else {
            return $this->respondWithError('Unauthorized', 401);
        }
    }
}
