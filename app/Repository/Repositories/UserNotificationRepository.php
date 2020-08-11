<?php
namespace App\Repository\Repositories;

use App\UserNotification;
use App\Repository\IRepositories\UserNotificationIRepository;

class UserNotificationRepository implements UserNotificationIRepository
{
    protected $model;

    public function __construct(UserNotification $model)
    {
        $this->model = $model;
    }

    public function getUserNotifications($user_id)
    {
        return $this->model->getAllUserNotifications($user_id);
    }

    public function getUserNotification($notification_id)
    {
        return $this->model->getUserNotification($notification_id);
    }

    public function readUserNotifications($user_id)
    {
        $this->model->readUserNotifications($user_id);
    }

    public function addUserNotification(UserNotificationRequest $request)
    {
        return $this->model->addUserNotification($request);
    }

    public function deleteUserNotifications($user_id)
    {
        return $this->model->deleteAllUserNotifications($user_id);
    }
}