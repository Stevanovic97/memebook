<?php
namespace App\Repository\Repositories;

use App\User;
use App\Repository\IRepositories\UserIRepository;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserIRepository{

    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getUserById($user_id)
    {
        return $this->model->getUserById($user_id);
    }

    public function getUser($user_id)
    {
        return $this->model->getUser($user_id);
    }

        function deleteUser($user_id)
    {
        return $this->model->deleteUser($user_id);
    }

    public function getNotifications()
    {
        return $this->model->getNotifications();
    }

    public function markNotificationAsRead($notificationId)
    {
        return $this->model->markNotificationAsRead($notificationId);
    }

    public function markNotificationsAsRead($userId)
    {
        return $this->model->markNotificationsAsRead($userId);
    }

}
