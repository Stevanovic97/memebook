<?php

namespace App;

final class MemeBookConstants 
{
    public function __construct()
    {
        
    }

    public static $notificationConstants = [
        'followUser' => 'App\\Notifications\\UserFollowed',
        'newMeme' => 'App\\Notifications\\NewMeme',
    ];
}