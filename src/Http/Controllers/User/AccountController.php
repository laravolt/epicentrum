<?php

namespace Laravolt\Epicentrum\Http\Controllers\User;

use Illuminate\Http\Request;

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

        return view('epicentrum::account.edit', compact('user', 'statuses', 'timezones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->repository->update($request->except('_token'), $id);
        \Krucas\Notification\Facades\Notification::success('Data akun berhasil diperbarui');

        return redirect()->back();
    }

}
