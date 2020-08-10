<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request\UserNotificationRequest;

class UserNotificationController extends Controller
{
    private $repository;

    public function __contruct(UserNotificationIRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param int $user_id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\UserNotificationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserNotificationRequest $request)
    {
        try
        {
            $validated = $request->validated();
            if ($this->repository->addUserNotification($request))
            {
                Session::flash('alert-success', 'success');
            }
        }
        catch (Exception $exception)
        {
            echo 'Error while trying to send user notification: ', $exception->getMessage(), "\n";
        }    
    }

    /**
     * Gets the notification
     *
     * @param  int  $notification_id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Reads all user notifications 
     * 
     * @param int $user_id
     * @return \Illuminate\Http\Response
     */
    public function readNotifications($user_id)
    {
        try
        {
            $this->repository->readUserNotifications($user_id);
            Session::flash('alert-success', 'success');
        }
        catch (Exception $exception)
        {
            echo 'Error while trying to read all notifications: ', $exception->getMessage(), "\n";
        }
    }

    /**
     * Remove all resources for specified user
     *
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
        try
        {
            if ($this->repository->deleteUserNotifications($user_id))
            {
                Session::flash('alert-success', 'success');
            }
        }
        catch (Exception $exception)
        {
            return $exception->getMessage();
        }
    }
}
