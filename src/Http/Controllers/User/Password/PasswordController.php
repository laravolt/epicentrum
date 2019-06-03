<?php

namespace Laravolt\Epicentrum\Http\Controllers\User\Password;

use App\Http\Controllers\Controller;
use Laravolt\Epicentrum\Repositories\RepositoryInterface;

class PasswordController extends Controller
{
    /**
     * @var UserRepositoryEloquent
     */
    private $repository;

    /**
     * PasswordController constructor.
     * @param  UserRepositoryEloquent  $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
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
}
