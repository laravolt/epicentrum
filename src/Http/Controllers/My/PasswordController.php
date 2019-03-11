<?php

namespace Laravolt\Epicentrum\Http\Controllers\My;

use Illuminate\Http\Request;
use Laravolt\Epicentrum\Http\Requests\My\Password\Update;
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = auth()->user();

        return view('epicentrum::my.password.edit', compact('user'));
    }

    public function update(Update $request)
    {
        if (app('hash')->check($request->password_current, auth()->user()->password)) {
            auth()->user()->setPassword($request->password);
            return redirect()->back()->withSuccess(trans('epicentrum::message.password_updated'));
        } else {
            return redirect()->back()->withError(trans('epicentrum::message.current_password_mismatch'));
        }

    }
}
