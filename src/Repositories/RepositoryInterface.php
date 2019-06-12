<?php

namespace Laravolt\Epicentrum\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface as BaseInterface;

/**
 * Interface UserRepository
 * @package namespace App\Repositories;
 */
interface RepositoryInterface extends BaseInterface
{
    public function createByAdmin(array $attributes, $roles = null);

    public function updateAccount($id, $account, $roles);

    public function updatePassword($password, $id);

    public function delete($id);

    public function availableStatus();
}
