<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request\UserNotificationRequest;

class UserNotificationController extends MemeBookBaseController
{
    public function index($user_id)
    {
        try
        {
            $notifications = $this->repository->getUserNotifications($user_id);
            return view('meme.notifications', $notifications);
        }
        catch (Exception $exception)
        {
            return $exception->getMessage();
        }
    }

    public function store(UserNotificationRequest $request)
    {
        try
        {
            $validated = $request->validated();
            $this->repository->addUserNotification($request);
        }
        catch (Exception $exception)
        {
            echo 'Error while trying to send user notification: ', $exception->getMessage(), "\n";
        }    
    }

    public function show($notification_id)
    {
        try
        {
            $notification = $this->repository->getUserNotification($user_id);
            return view('meme.notification', $notification);
        }
        catch (Exception $exception)
        {
            return $exception->getMessage();
        }
    }

    public function readNotifications($user_id)
    {
        try
        {
            $this->repository->readUserNotifications($user_id);
        }
        catch (Exception $exception)
        {
            echo 'Error while trying to read all notifications: ', $exception->getMessage(), "\n";
        }
    }

    public function destroy($user_id)
    {
        try
        {
            $deleted = $this->repository->deleteUserNotifications($user_id);
        }
        catch (Exception $exception)
        {
            return $exception->getMessage();
        }
    }
}
