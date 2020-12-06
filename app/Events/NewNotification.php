<?php

namespace App\Events;

use App\User;
use App\Meme;
use Illuminate\Support\Carbon;
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
    public function __construct(User $user, Meme $meme = null, $typeOfNotification)
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
        $notification = $this->fromUser->getNotification($this->toUser->id);
        $fromUserInfo = array(
            'fromUserId' => $this->fromUser->id,
            'fromUserName' => $this->fromUser->name,
            'fromUserAvatar' => $this->fromUser->avatar,
            'notifiable_type' => $this->typeOfNotification,
            'created_date' => Carbon::parse($notification['created_at'])->toDateTimeString(),
            'id' => $notification->id,
        );
        if ($this->meme != null)
        {
            $fromUserInfo['meme_id'] = $this->meme->id; 
        }
        return array_merge($this->fromUser->toArray(), $fromUserInfo);
    }
}
