<?php

namespace App\Observers;

use App\Meme;
use App\Notifications\NewMeme;
use App\Events\NewNotification;
use App\MemeBookConstants;

class MemeObserver
{
    public function created(Meme $meme)
    {
        $user = $meme->user;
        foreach ($user->followers as $follower) {
            $follower->notify(new NewMeme($user, $meme));
            event(new NewNotification($follower, $meme, MemeBookConstants::$notificationConstants['newMeme']));
        }
    }
}
