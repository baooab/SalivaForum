<?php

namespace App\Models;

use App\Models\Link;
use App\Models\Comment;
use App\Models\Discussion;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const DEFAULT = 1;
    const MODERATOR = 2;
    const ADMIN = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'avatar', 'email', 'password', 'confirmation_code', 'confirmed', 'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'confirmation_code', 'confirmed',
    ];

    public static function findByEmail(string $email): User
    {
        return static::where('email', $email)->firstOrFail();
    }

    public static function findByUsername(string $username): User
    {
        return static::where('username', $username)->firstOrFail();
    }

    public function isConfirmed(): bool
    {
        return (bool) $this->confirmed;
    }

    public function isUnconfirmed()
    {
        return ! $this->isConfirmed();
    }

    public function matchesConfirmationCode(string $code): bool
    {
        return $this->confirmation_code === $code;
    }

    public function confirm()
    {
        $this->update(['confirmed' => true, 'confirmation_code' => null]);
    }


    /**
     * 发送重置密码邮件
     */

    public function sendPasswordResetNotification($token)
    {
        Mail::to($this->email)->send(new ResetPassword($token));
    }

    /**
     * 用户身份
     */
    public function isModerator(): bool
    {
        return $this->type === self::MODERATOR;
    }

    public function isAdmin(): bool
    {
        return $this->type === self::ADMIN;
    }

    /**
     * 用户关联关系设定
     */

    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function links()
    {
        return $this->hasMany(Link::class);
    }


    /**
     * 用户贡献统计
     */

    public function countDiscussions()
    {
        return $this->discussions()->count();
    }

    public function countComments()
    {
        return $this->comments()->count();
    }

    public function countLinks()
    {
        return $this->links()->count();
    }

    /**
     * 用户最新信息
     */

    public function latestDiscussions()
    {
        return Discussion::where('user_id', $this->id)->latest('updated_at')->take(3)->get();
    }

    public function latestComments()
    {
        return Comment::where('user_id', $this->id)->latest('updated_at')->take(3)->get();
    }

    public function latestLinks()
    {
        return Link::where('user_id', $this->id)->latest('updated_at')->take(3)->get();
    }
}
