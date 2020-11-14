<?php

namespace App\Events;

use App\User;
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

    public $fromUser;
    public $toUser;
    public $typeOfNotification;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $typeOfNotification)
    {
        $this->fromUser = Auth::user();
        $this->toUser = $user;
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
        $fromUserInfo = [
            'fromUserId' => $this->fromUser->id,
            'fromUserName' => $this->fromUser->name,
            'notificationType' => $this->typeOfNotification
        ];

        return array_merge($this->toUser->toArray(), $fromUserInfo);
    }
}
