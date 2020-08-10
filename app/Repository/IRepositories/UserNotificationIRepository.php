<?php
namespace App\Repository\IRepositories;

use App\Http\Requests\UserNotificationRequest;

interface UserNotificationIRepository
{
    function getUserNotifications($user_id);
    function getUserNotification($notification_id);
    function readUserNotifications($user_id);
    function addUserNotification(UserNotificationRequest $request);
    function deleteUserNotifications($user_id);
}