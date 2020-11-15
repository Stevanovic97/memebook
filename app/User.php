<?php

namespace App;

use App\Meme;
use App\MessageHelper;
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
        'name', 'email', 'password', 'avatar'
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

    public function getUser($user_id)
    {
        $user = User::where('id', $user_id)->first();
        return $user;
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
        $followMessage = MessageHelper::ToastMessage('Success', 'Your are now following ' . $followedUser->name);
        return compact('followMessage');
    }

    public function unfollow($userId)
    {
        $this->follows()->detach($userId);
        $user = User::where('id', $userId)->first();
        return MessageHelper::ToastMessage('Warning', 'You are no longer following ' . $user->name);
    }

    public function isFollowing($userId)
    {
        $exists = $this->follows()->where('follows_id', $userId)->count();
        return $exists > 0;
    }

    public function getNotifications()
    {
        return auth()->user() ? auth()->user()->unreadNotifications()->get()->toArray() : null;
    }

    public function getNotification($userId)
    {
        $user = User::where('id', $userId)->first();
        $createdNotification = $user->unreadNotifications()->where('notifiable_id', $userId)->first();
        return $createdNotification;
    }

    public function markNotificationAsRead($notificationId)
    {
        $notification = auth()->user()->unreadNotifications()->where('id', $notificationId)->first();
        $notification->markAsRead();
        $url = $this->createNotificationUrl($notification);

        return $url;
    }

    private function createNotificationUrl($notification)
    {
        if (strpos($notification->type, "UserFollowed") !== false)
        {
            return route('user.show', $notification->data['follower_id']);
        }
        else if (strpos($notification->type, "NewMeme") !== false)
        {
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
            'id'     => $user->id,
            'name'   => $user->name,
            'email'  => $user->email,
            'url'    => '',  // Optional
            'avatar' => 'gravatar',  // Default avatar
            'admin'  => $user->role === 'admin', // bool
        ];
    }
}
