<?php

namespace Laravolt\Epicentrum\Http\Controllers\User;

use Laravolt\Epicentrum\Contracts\Requests\Account\Update;

class AccountController extends UserController
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->repository->skipPresenter()->find($id);
        $statuses = $this->repository->availableStatus();
        $timezones = $this->timezone->lists();
        $roles = app('laravolt.epicentrum.role')->all();
        $multipleRole = config('laravolt.epicentrum.role.multiple');

        return view('epicentrum::account.edit', compact('user', 'statuses', 'timezones', 'roles', 'multipleRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, $id)
    {
        try {
            $this->repository->updateAccount($id, $request->except('_token'), $request->get('roles', []));

            return redirect()->back()->withSuccess(trans('epicentrum::message.account_updated'));
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
