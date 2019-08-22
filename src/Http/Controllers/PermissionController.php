<?php

namespace Laravolt\Epicentrum\Http\Controllers;

use Illuminate\Routing\Controller;

class PermissionController extends Controller
{
    public function edit()
    {
        $permissions = (new \PermissionRepo())->all()->sortBy(function ($item) {
            return strtolower($item->name);
        });

        return view('epicentrum::permissions.edit', compact('permissions'));
    }

    public function update()
    {
        foreach (request('permission', []) as $key => $description) {
            (new \PermissionRepo())->updateAll($key, $description);
        }

        return redirect()->back()->withSuccess('Permission updated');
    }
}
