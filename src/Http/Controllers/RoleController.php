<?php

namespace Laravolt\Epicentrum\Http\Controllers;

use Illuminate\Routing\Controller;
use Laravolt\Acl\Models\Permission;
use Laravolt\Epicentrum\Http\Requests\Role\Store;
use Laravolt\Epicentrum\Http\Requests\Role\Update;
use Laravolt\Epicentrum\Repositories\RoleRepository;
use Laravolt\Epicentrum\Repositories\RoleRepositoryInterface;

class RoleController extends Controller
{
    /**
     * @var RoleRepositorye
     */
    protected $repository;

    /**
     * UserController constructor.
     * @param  RoleRepository  $repository
     */
    public function __construct(RoleRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->repository->all();

        return view('epicentrum::roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('epicentrum::roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        $role = $this->repository->create($request->all());

        return redirect()->route('epicentrum::roles.index')->withSuccess(trans('epicentrum::message.role_created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = $this->repository->findById($id);
        $permissions = Permission::all();
        $assignedPermissions = old('permissions', $role->permissions()->pluck('id')->toArray());

        return view('epicentrum::roles.edit', compact('role', 'permissions', 'assignedPermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, $id)
    {
        $role = $this->repository->update($id, $request->all());

        return redirect()->route('epicentrum::roles.index')->withSuccess(trans('epicentrum::message.role_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);

        return redirect()->route('epicentrum::roles.index')->withSuccess(trans('epicentrum::message.role_deleted'));
    }
}
