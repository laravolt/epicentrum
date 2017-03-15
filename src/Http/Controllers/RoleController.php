<?php

namespace Laravolt\Epicentrum\Http\Controllers;

use App\Http\Controllers\Controller;
use Laravolt\Acl\Models\Permission;
use Laravolt\Acl\Models\Role;
use Laravolt\Epicentrum\Http\Requests\Role\Store;
use Laravolt\Epicentrum\Http\Requests\Role\Update;

class RoleController extends Controller
{
    /**
     * RoleController constructor.
     */
    public function __construct()
    {
        //$this->authorize(\App\Enum\Permission::MANAGE_ROLE);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        $role = Role::create($request->only('name'));
        $role->syncPermission($request->get('permissions', []));

        return redirect()->route('epicentrum::roles.index')->withSuccess(trans('epicentrum::message.role_created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $assignedPermissions = old('permissions', $role->permissions()->pluck('id')->toArray());

        return view('epicentrum::roles.edit', compact('role', 'permissions', 'assignedPermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->name = $request->get('name');
        $role->save();

        $role->syncPermission($request->get('permissions', []));

        return redirect()->route('epicentrum::roles.index')->withSuccess(trans('epicentrum::message.role_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::findOrFail($id)->delete();

        return redirect()->route('epicentrum::roles.index')->withSuccess(trans('epicentrum::message.role_deleted'));
    }
}
