<?php

namespace Laravolt\Epicentrum\Console\Commands;

use Illuminate\Console\Command;
use Laravolt\Acl\Models\Role;

class ManageUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravolt:manage-user {user?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'User management for superuser';

    protected $menu = [
        1 => 'Change Role',
        2 => 'Change Password',
    ];

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = $this->validateUser($this->argument('user'));

        $this->chooseAction($user);

    }

    protected function validateUser($identifier)
    {
        if (!$identifier) {
            $identifier = $this->ask('ID or email');
        }

        $user = app(config('auth.providers.users.model'))->find($identifier);

        if (!$user) {
            $user = app(config('auth.providers.users.model'))->whereEmail($identifier)->first();
        }

        if(!$user) {
            $this->error('User not found');
        }

        return $user;
    }

    protected function chooseAction($user)
    {
        $message = sprintf('What do you want to do with user %s (ID: %s)', $user->email, $user->getKey());
        $action = camel_case($this->choice($message, $this->menu));

        $this->{'action'.$action}($user);
    }

    protected function actionChangeRole($user)
    {
        $roles = Role::pluck('name', 'id')->sortKeys();
        $options = (clone $roles)->prepend('all', 0);

        $selected = $this->choice('Type roles ID, separate by comma', $options->toArray(), null, null, true);

        if (collect($selected)->search('all') !== false) {
            $selected = $roles;
        }

        return $user->syncRoles($selected);
    }

    protected function actionChangePassword()
    {

    }
}
