<?php

namespace App;

use App\Meme;
use App\MessageHelper;
use Illuminate\Support\Facades\URL;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function memes()
    {
        return $this->hasMany('App\Meme');
    }

    public function getUserById($user_id)
    {
        $user = User::findOrFail($user_id);
        return $user;
    }

    public function getUser($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->avatar = URL::to('/') . $user->avatar;
        $user->following = $user->follows()->count();
        $user->followers = $user->followers()->count();

        return $user;
    }

    public function deleteUser($user_id)
    {
        $user = User::FindOrFail($user_id);
        $user->memes()->delete();
        $user->delete();
    }

    public function followers()
    {
        return $this->belongsToMany(self::class, 'followers', 'follows_id', 'user_id')
            ->withTimestamps();
    }

    public function follows()
    {
        return $this->belongsToMany(self::class, 'followers', 'user_id', 'follows_id')
            ->withTimestamps();
    }

    public function follow($userId)
    {
        $this->follows()->attach($userId);
        $followedUser = User::where('id', $userId)->first();
        $followMessage = MessageHelper::Success('Your are now following ' . $followedUser->name);

        return compact('followMessage');
    }

    public function unfollow($userId)
    {
        $this->follows()->detach($userId);
        $user = User::where('id', $userId)->first();

        return MessageHelper::Warning('You are no longer following ' . $user->name);
    }

    public function isFollowing($userId)
    {
        $exists = $this->follows()->where('follows_id', $userId)->count();
        return $exists > 0;
    }

    public function getNotifications()
    {
        $user = auth()->user();
        if ($user) {
            $notifications = $user->notifications()->get();
            $notificationsData = json_decode($notifications);
            $notificationsJSON = array();

            foreach ($notificationsData as $notification) {
                $tuple = array('read_at' => $notification->read_at,
                    'id' => $notification->id,
                    'created_date' => $notification->created_at,
                    'notifiable_type' => $notification->type,
                    'fromUserName' => $notification->data->follower_name,
                    'fromUserAvatar' => $notification->data->follower_avatar,
                    'follower_id' => $notification->data->follower_id
                );
                $notificationsJSON[] = $tuple;
            }
            return $notificationsJSON;
        }
        return null;
    }

    public function getNotification($userId)
    {
        $user = User::where('id', $userId)->first();
        $createdNotification = $user->notifications()->where('notifiable_id', $userId)->first();

        return $createdNotification;
    }

    public function markNotificationAsRead($notificationId)
    {
        $notification = auth()->user()->notifications()->where('id', $notificationId)->first();
        if (!$notification->read_at)
            $notification->markAsRead();
        $url = $this->createNotificationUrl($notification);

        return $url;
    }

    public function markNotificationsAsRead($userId)
    {
        foreach (auth()->user()->unreadNotifications as $notification) {
            if (!$notification->read_at)
                $notification->markAsRead();
        }
        return true;
    }

    private function createNotificationUrl($notification)
    {
        if (strpos($notification->type, "UserFollowed") !== false) {
            return route('user.show', $notification->data['follower_id']);
        } else if (strpos($notification->type, "NewMeme") !== false) {
            return route('meme.single', $notification->data['meme_id']);
        }
    }

    /**
     * Return the user attributes.
     * @return array
     */
    public static function getAuthor($id)
    {
        $user = self::find($id);
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'url' => '',  // Optional
            'avatar' => 'gravatar',  // Default avatar
            'admin' => $user->role === 'admin', // bool
        ];
    }
}
