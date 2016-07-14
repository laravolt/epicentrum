<?php

namespace Laravolt\Epicentrum\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravolt\Acl\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
use Laravolt\Acl\Traits\HasRoleAndPermission;
use Laravolt\Auth\Traits\HasSocialAccount;
use Laravolt\Mural\Contracts\Commentator;
use Laravolt\Password\CanChangePassword;
use Laravolt\Password\CanChangePasswordContract;
use Prettus\Repository\Contracts\Presentable;
use Prettus\Repository\Traits\PresentableTrait;
use Avatar;

class User extends Authenticatable implements CanResetPassword,
    CanChangePasswordContract,
    Commentator,
    Presentable,
    HasRoleAndPermissionContract
{
    use CanChangePassword, PresentableTrait, HasSocialAccount, HasRoleAndPermission, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'status', 'rkn_id', 'centrum_user_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected $dates = ['password_last_set', 'deleted_at'];

    protected $with = ['profile'];

    protected static function boot()
    {
        static::created(function ($user) {
            $user->profile()->save(new Profile());
        });

        parent::boot();
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function getCommentatorNameAttribute()
    {
        return $this['name'];
    }

    public function getCommentatorAvatarAttribute()
    {
        return Avatar::create($this->attributes['name'])->toBase64();
    }

    public function getCommentatorPermalinkAttribute()
    {
        return url('users/' . $this->id);
    }

    public function canModerateComment()
    {
        return true;
    }

    public function getTimezoneAttribute()
    {
        if ($this->profile) {
            return $this->profile->timezone;
        }

        return config('app.timezone');
    }

    public function getAvatar()
    {
        return Avatar::create($this->name)->toBase64();
    }

    public function isAdmin()
    {
        return ! $this->isPenyedia();
    }

    public function isPenyedia()
    {
        return (int)$this->attributes['rkn_id'] > 0;
    }

    function __toString()
    {
        return $this->name;
    }

}
