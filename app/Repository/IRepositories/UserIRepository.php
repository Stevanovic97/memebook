<?php

namespace App\Repository\IRepositories;


interface UserIRepository
{
    function getUserById($user_id);

    function getUser($user_id);

    function getNotifications();

    function markNotificationAsRead($notificationId);
}
