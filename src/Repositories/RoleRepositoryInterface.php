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

    public function create(Request $request);

    public function update($id, Request $request);

    public function delete($id);
}
