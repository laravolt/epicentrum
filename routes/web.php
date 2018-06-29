<?php

$router->group(
    [
        'namespace'  => '\Laravolt\Epicentrum\Http\Controllers',
        'prefix'     => config('laravolt.epicentrum.route.prefix'),
        'as'         => 'epicentrum::',
        'middleware' => config('laravolt.epicentrum.route.middleware'),
    ],
    function ($router) {

        $router->get('/', ['uses' => 'DefaultController@index', 'as' => 'index']);

        $router->group(['namespace' => 'User'], function ($router) {

            $router->group(['middleware' => 'can:'.\Laravolt\Epicentrum\Permission::MANAGE_USER], function ($router) {
                $router->resource('users', 'UserController', [
                    'names' => [
                        'index'   => 'users.index',
                        'create'  => 'users.create',
                        'store'   => 'users.store',
                        'show'    => 'users.show',
                        'edit'    => 'users.edit',
                        'update'  => 'users.update',
                        'destroy' => 'users.destroy',
                    ],
                ]);

                $router->resource('password', 'PasswordController', [
                    'names' => [
                        'edit' => 'password.edit',
                    ],
                ]);
                $router->post('password/{id}/reset', ['uses' => 'PasswordController@reset', 'as' => 'password.reset']);
                $router->post(
                    'password/{id}/generate',
                    ['uses' => 'PasswordController@generate', 'as' => 'password.generate']
                );

                $router->resource('account', 'AccountController', [
                    'names' => [
                        'edit'   => 'account.edit',
                        'update' => 'account.update',
                    ],
                ]);

                $router->resource(
                    'role',
                    'RoleController',
                    [
                        'only'  => ['edit', 'update'],
                        'names' => [
                            'edit'   => 'role.edit',
                            'update' => 'role.update',
                        ],
                    ]
                );
            });
        });

        $router->resource('roles', 'RoleController', [
            'names'      => [
                'index'   => 'roles.index',
                'create'  => 'roles.create',
                'store'   => 'roles.store',
                'show'    => 'roles.show',
                'edit'    => 'roles.edit',
                'update'  => 'roles.update',
                'destroy' => 'roles.destroy',
            ],
            'middleware' => 'can:'.\Laravolt\Epicentrum\Permission::MANAGE_ROLE,
        ]);
    }
);
