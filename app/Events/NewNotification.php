<?php

namespace App\Events;

use App\User;
use App\Meme;
use Illuminate\Support\Facades\Auth;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $meme;
    public $fromUser;
    public $toUser;
    public $typeOfNotification;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Meme $meme = NULL, $typeOfNotification)
    {
        $this->fromUser = Auth::user();
        $this->toUser = $user;
        $this->meme = $meme;
        $this->typeOfNotification = $typeOfNotification;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('memebook-channel.' . $this->toUser->id);
    }

    public function broadcastWith()
    {
        $notification_id = $this->fromUser->getNotification($this->toUser->id)->id;
        $fromUserInfo = array(
            'fromUserId' => $this->fromUser->id,
            'fromUserName' => $this->fromUser->name,
            'notificationType' => $this->typeOfNotification,
            'id' => $notification_id
        );

        if ($this->meme != NULL)
        {
            $fromUserInfo['meme_id'] = $this->meme->id; 
        }
        return array_merge($this->toUser->toArray(), $fromUserInfo);
    }
}
