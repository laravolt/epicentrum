<?php

namespace Laravolt\Epicentrum\Http\Controllers;

use Illuminate\Routing\Controller;
use Laravolt\Acl\Models\Permission;

class PermissionController extends Controller
{
    public function edit()
    {
        $permissions = Permission::all()->sortBy(function ($item) {
            return strtolower($item->name);
        });

        return view('epicentrum::permissions.edit', compact('permissions'));
    }

    public function update()
    {
        foreach (request('permission', []) as $key => $description) {
            Permission::whereId($key)->update(['description' => $description]);
        }

        return redirect()->back()->withSuccess('Permission updated');
    }
}
