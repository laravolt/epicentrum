<?php

namespace Laravolt\Epicentrum\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Laravolt\Acl\Models\Role;
use Laravolt\Epicentrum\Http\Requests\CreateAccount;
use Laravolt\Epicentrum\Repositories\RepositoryInterface;
use Illuminate\Support\Facades\Mail;
use Krucas\Notification\Facades\Notification;


class UserController extends Controller
{
    /**
     * @var UserRepositoryEloquent
     */
    protected $repository;

    /**
     * @var TimezoneRepositoryArray
     */
    protected $timezone;

    /**
     * UserController constructor.
     * @param UserRepositoryEloquent $repository
     * @param TimezoneRepositoryArray $timezone
     */
    public function __construct(RepositoryInterface $repository, \Laravolt\Support\Repositories\TimezoneRepositoryArray $timezone)
    {
        $this->repository = $repository;
        $this->timezone = $timezone;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->repository->skipPresenter()->paginate();
        return view('epicentrum::index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $statuses = $this->repository->availableStatus();
        $roles = Role::all()->pluck('name', 'id');

        return view('epicentrum::create', compact('statuses', 'roles'));
    }

    /**
     * Store the specified resource.
     *
     * @param CreateAccount $request
     * @return Response
     */
    public function store(CreateAccount $request)
    {
        // save to db
        $roles = $request->get('roles', []);
        $user = $this->repository->createByAdmin($request->only('name', 'email', 'password', 'status', 'must_change_password'), $roles);
        $password = $request->get('password');

        // send account info to email
        if($request->has('send_account_information')) {
            Mail::send('emails.account_information', compact('user', 'password'), function($message) use ($user) {
                $message->subject('Your Account Information');
                $message->to($user->email);
            });
        }

        Notification::success(trans('users.creation_success'));
        return redirect()->route('epicentrum::users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return redirect(route('epicentrum::profile.edit', $id));
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        Notification::warning('User berhasil dihapus');
        return redirect(route('epicentrum::users.index'));
    }
}
