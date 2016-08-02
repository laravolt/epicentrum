<?php

Route::group(
    [
        'namespace'  => '\Laravolt\Epicentrum\Http\Controllers',
        'prefix'     => config('epicentrum.route.prefix'),
        'as'         => 'epicentrum::',
        'middleware' => config('epicentrum.route.middleware')
    ],
    function () {

        Route::group(['namespace' => 'User'], function () {

            Route::resource('users', 'UserController', [
                'names' => [
                    'index'   => 'users.index',
                    'create'  => 'users.create',
                    'store'   => 'users.store',
                    'show'    => 'users.show',
                    'edit'    => 'users.edit',
                    'update'  => 'users.update',
                    'destroy' => 'users.destroy'
                ]
            ]);

            Route::resource('password', 'PasswordController', [
                'names' => [
                    'edit' => 'password.edit',
                ]
            ]);
            Route::post('password/{id}/reset', ['uses' => 'PasswordController@reset', 'as' => 'password.reset']);
            Route::post('password/{id}/generate',
                ['uses' => 'PasswordController@generate', 'as' => 'password.generate']);


            Route::resource('account', 'AccountController', [
                'names' => [
                    'edit'   => 'account.edit',
                    'update' => 'account.update',
                ]
            ]);

            Route::resource(
                'role',
                'RoleController',
                [
                    'only'  => ['edit', 'update'],
                    'names' => [
                        'edit'   => 'role.edit',
                        'update' => 'role.update',
                    ]
                ]
            );
        });

        Route::resource('roles', 'RoleController', [
            'names' => [
                'index'   => 'roles.index',
                'create'  => 'roles.create',
                'store'   => 'roles.store',
                'show'    => 'roles.show',
                'edit'    => 'roles.edit',
                'update'  => 'roles.update',
                'destroy' => 'roles.destroy'
            ]
        ]);
    });
