<?php

namespace Laravolt\Epicentrum\Repositories;

use Illuminate\Http\Request;

/**
 * Interface UserRepository
 * @package namespace App\Repositories;
 */
interface RoleRepositoryInterface
{
    public function findById(int $id);

    public function all();

    public function create(array $attributes);

    public function update($id, array $attributes);

    public function delete($id);
}
