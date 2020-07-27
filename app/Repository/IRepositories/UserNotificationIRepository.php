<?php
namespace App\Repository\IRepositories;

use App\UserNotification;
use App\Meme;

interface CommentIRepository
{
    public function getUserNotifications($user_id);
    public function getUserNotification($notification_id);
    public function readUserNotifications($user_id);
    public function deleteUserNotifications($user_id);
    public function addUserNotification(UserNotificationRequest $request);
}