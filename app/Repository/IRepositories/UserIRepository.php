<?php

namespace App\Repository\IRepositories;


interface UserIRepository
{
    function getUser($user_id);
    function getNotifications();
    function markNotificationAsRead($notificationId);
}
