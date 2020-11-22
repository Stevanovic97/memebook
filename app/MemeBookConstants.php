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

    public static $reasonsToReport = [
        '1' => 'Uncivil, rude or vulgar',
        '2' => 'Discrimination',
        '3' => 'Goes against my beliefs, values or politics',
        '4' => 'Commercial or self promotion',
        '5-posting' => 'Over-posting',
        '6' => 'Contains illegal content or activity'
    ];
}