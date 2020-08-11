<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserNotification extends Model
{
    protected $fillable = ['type_of_notification', 'data', 'read_at'];

    public function notifications($user_id)
    {
        return $this->belongsTo('App\User');
    }

    public function getAllUserNotifications($user_id)
    {
        try
        {
            return UserNotification::where('user_id', $user_id)->get();
        }
        catch (Exception $exception)
        {
            return $exception->getMessage();
        }
    }

    public function getUserNotification($notification_id)
    {
        try
        {
            return UserNotification::where('id', $notification_id)->get();
        }
        catch (Exception $exception)
        {
            return $exception->getMessage();
        }
    }

    public function readUserNotifications($user_id)
    {
        UserNotification::where('user_id', $user_id)->update(['read' => true, 'read_at' => Carbon::now()->timestamp]);
    }

    public function addUserNotification(UserNotificationRequest $request)
    {
        UserNotification::create([
            'type_of_notification' => $request->typeOfNotification,
            'data' => $request->data,
            'user_id' => $request->userId,
            'read' => false
        ]);
        return true;
    }

    public function deleteAllUserNotifications($user_id)
    {
        UserNotification::where('user_id', $user_id)->delete();
        return true;
    }
}
