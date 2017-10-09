<?php

namespace Laravolt\Epicentrum\Http\Controllers;

use Illuminate\Routing\Controller;
use Laravolt\Acl\Models\Permission;
use Laravolt\Epicentrum\Http\Requests\Role\Store;
use Laravolt\Epicentrum\Http\Requests\Role\Update;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = app('laravolt.epicentrum.role')->all();

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
        $role = app('laravolt.epicentrum.role')->create($request->only('name'));
        $role->syncPermission($request->get('permissions', []));

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
        app('laravolt.acl')->syncPermission();

        $role = app('laravolt.epicentrum.role')->findOrFail($id);
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
        $role = app('laravolt.epicentrum.role')->findOrFail($id);
        $role->name = $request->get('name');
        $role->save();

        $role->syncPermission($request->get('permissions', []));

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
        app('laravolt.epicentrum.role')->findOrFail($id)->delete();

        return redirect()->route('epicentrum::roles.index')->withSuccess(trans('epicentrum::message.role_deleted'));
    }
}
