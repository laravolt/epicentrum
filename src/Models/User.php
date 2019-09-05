<?php

namespace Laravolt\Epicentrum\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravolt\Acl\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
use Laravolt\Acl\Traits\HasRoleAndPermission;
use Laravolt\Avatar\Facade as Avatar;
use Laravolt\Password\CanChangePassword;
use Laravolt\Password\CanChangePasswordContract;
use Laravolt\Password\CanResetPassword as CanResetPasswordTrait;
use Laravolt\Suitable\AutoFilter;
use Laravolt\Suitable\AutoSort;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class User extends Authenticatable implements
    CanResetPassword,
    CanChangePasswordContract,
    HasRoleAndPermissionContract
{
    use CanChangePassword, HasRoleAndPermission, CanResetPasswordTrait, AutoSort, AutoFilter;

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'status', 'timezone'];

    /**
     * The attributes excluded from the model's JSON form.
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected $dates = ['password_last_set', 'deleted_at'];

    protected $with = ['roles'];

    public function getAvatarAttribute()
    {
        $url = null;
        if ($this instanceof HasMedia) {
            $url = $this->getFirstMediaUrl('avatar');
        }

        return $url ?: Avatar::create($this->name)->toBase64();
    }
}
