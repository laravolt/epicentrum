<?php

namespace Laravolt\Epicentrum\Repositories;

use App\Enum\UserStatus;
use Carbon\Carbon;
use Laravolt\Epicentrum\Presenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class UserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class EloquentRepository extends BaseRepository implements RepositoryInterface
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'  => 'like',
        'email' => 'like'
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return config('auth.providers.users.model');
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return Presenter::class;
    }

    /**
     * Save a new entity in repository
     *
     * @throws ValidatorException
     * @param array $attributes
     * @return mixed
     */
    public function createByAdmin(array $attributes, $roles = null)
    {
        parent::skipPresenter();

        $attributes['password_last_set'] = new Carbon();
        if (array_has($attributes, 'must_change_password')) {
            $attributes['password_last_set'] = null;
        }

        $attributes['password'] = bcrypt($attributes['password']);

        $user = parent::create($attributes);

        $user->syncRoles($roles);

        return $user;
    }


    public function updatePassword($password, $id)
    {
        $user = $this->skipPresenter()->find($id);
        $user->setPassword($password);

        return $user->save();
    }

    public function availableStatus()
    {
        return UserStatus::toArray();
    }

}
