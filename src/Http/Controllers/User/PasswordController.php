<?php

namespace Laravolt\Epicentrum\Http\Controllers\User;

use Illuminate\Http\Request;
use Laravolt\Password\Password;
use App\Http\Controllers\Controller;
use Laravolt\Epicentrum\Repositories\RepositoryInterface;

class PasswordController extends Controller
{
    /**
     * @var UserRepositoryEloquent
     */
    private $repository;

    /**
     * @var Password
     */
    private $password;

    /**
     * PasswordController constructor.
     * @param UserRepositoryEloquent $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->password = app('password');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->repository->skipPresenter()->find($id);
        return view('epicentrum::password.edit', compact('user'));
    }

    public function reset($id)
    {
        $user = $this->repository->skipPresenter()->find($id);
        $this->password->sendResetLink($user);

        return redirect()->back()->withSuccess(trans('epicentrum::message.password_reset_sent'));
    }

    public function generate(Request $request, $id)
    {
        $user = $this->repository->skipPresenter()->find($id);
        $this->password->sendNewPassword($user, $request->has('must_change_password'));

        return redirect()->back()->withSuccess(trans('epicentrum::message.password_changed_and_sent_to_email'));
    }
}
