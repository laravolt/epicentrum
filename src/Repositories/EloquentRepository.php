<?php

namespace Laravolt\Epicentrum\Repositories;

use App\Enum\UserStatus;
use App\Exceptions\SikapException;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\ValidationException;
use Laravolt\Epicentrum\Models\Profile;
use Laravolt\Epicentrum\Presenter;
use Laravolt\Epicentrum\Models\User;
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
        return User::class;
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

        $user->roles()->sync($roles);

        $this->updateProfile($attributes, $user['id']);

        return $user;
    }


    /**
     * Update a entity in repository by id
     *
     * @throws ValidatorException
     * @param array $attributes
     * @param       $id
     * @return mixed
     */
    public function updateProfile(array $attributes, $id)
    {
        $this->skipPresenter();
        $user = $this->find($id);

        $profile = $user->profile;
        if (!$profile) {
            $profile = new Profile();
        }
        $profile->fill(array_only($attributes, ['bio', 'timezone']));

        return $user->profile()->save($profile);
    }

    public function updatePassword($password, $id)
    {
        $user = $this->skipPresenter()->find($id);
        $user->setPassword($password);

        return $user->save();
    }

    public function availableStatus()
    {
        $status = [UserStatus::PENDING(), UserStatus::ACTIVE(), UserStatus::BLOCKED()];
        return array_combine($status, $status);
    }

    /**
     * Create local user when "Penyedia" login via sikap
     *
     * @throws ValidatorException
     * @param array $attributes
     * @return mixed
     */
    public function createViaSikap($rknId, $name, $email, $attributes)
    {
        parent::skipPresenter();

        $this->validateEmail($email, $rknId, 'rkn_id');

        $user = $this->model->updateOrCreate(
            ['rkn_id' => $rknId],
            [
                'name'   => $name,
                'email'  => $email,
                'status' => UserStatus::PENYEDIA
            ]
        );

        $user->profile->rekanan_data = $attributes;
        $user->profile->save();

        return $user;
    }

    /**
     * Create local user when "User" login via centrum
     *
     * @throws ValidatorException
     * @param array $attributes
     * @return mixed
     */
    public function createViaCentrum($centrumUserId, $name, $email, $attributes, $roles)
    {
        parent::skipPresenter();

        $this->validateEmail($email, $centrumUserId, 'centrum_user_id');

        $user = $this->model->updateOrCreate(
            ['centrum_user_id' => $centrumUserId],
            [
                'name'   => $name,
                'email'  => $email,
                'status' => UserStatus::CENTRUM
            ]
        );

        $user->syncRoles($roles);

        $user->profile->rekanan_data = $attributes;
        $user->profile->save();

        return $user;
    }

    protected function validateEmail($email, $rknId, $identifierColumn)
    {
        // validate email format
        $validEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$validEmail) {
            throw new SikapException('Maaf, Anda belum bisa login karena alamat email tidak terbaca.');
        }

        // validate if email already used
        $exists = $this->model->whereEmail($email)->where($identifierColumn, '<>', $rknId)->exists();
        if($exists) {
            throw new SikapException('Maaf, login gagal karena alamat email Anda sudah terdaftar atas nama pengguna lain.');
        }

        return true;
    }
}
