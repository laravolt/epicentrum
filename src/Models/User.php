<?php

namespace Laravolt\Epicentrum\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravolt\Acl\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
use Laravolt\Acl\Traits\HasRoleAndPermission;
use Laravolt\Auth\Traits\CanResetPassword as CanResetPasswordTrait;
use Laravolt\Avatar\Facade as Avatar;
use Laravolt\Password\CanChangePassword;
use Laravolt\Password\CanChangePasswordContract;
use Prettus\Repository\Contracts\Presentable;
use Prettus\Repository\Traits\PresentableTrait;

class User extends Authenticatable implements
    CanResetPassword,
    CanChangePasswordContract,
    Presentable,
    HasRoleAndPermissionContract
{
    use CanChangePassword, PresentableTrait, HasRoleAndPermission, SoftDeletes, CanResetPasswordTrait;

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

    public function getAvatar()
    {
        return Avatar::create($this->name)->toBase64();
    }

    public function getStatusLabel()
    {
        return $this->status;
    }
}
