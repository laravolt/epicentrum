<?php

Route::group(
    [
        'namespace'  => '\Laravolt\Epicentrum\Http\Controllers',
        'prefix'     => 'backoffice',
        'middleware' => ['web', 'auth']
    ],
    function () {

        Route::group(['prefix' => 'users', 'namespace' => 'User'], function(){

            Route::resource('users', 'UserController', [
                'names' => [
                    'index'   => 'admin.users.index',
                    'create'  => 'admin.users.create',
                    'store'   => 'admin.users.store',
                    'show'    => 'admin.users.show',
                    'edit'    => 'admin.users.edit',
                    'update'  => 'admin.users.update',
                    'destroy' => 'admin.users.destroy'
                ]
            ]);

            Route::resource('profile', 'ProfileController', [
                'names' => [
                    'index'   => 'admin.profile.index',
                    'create'  => 'admin.profile.create',
                    'store'   => 'admin.profile.store',
                    'show'    => 'admin.profile.show',
                    'edit'    => 'admin.profile.edit',
                    'update'  => 'admin.profile.update',
                    'destroy' => 'admin.profile.destroy'
                ]
            ]);

            Route::resource('password', 'PasswordController', [
                'names' => [
                    'edit' => 'admin.password.edit',
                ]
            ]);
            Route::post('password/{id}/reset', ['uses' => 'PasswordController@reset', 'as' => 'admin.password.reset']);
            Route::post('password/{id}/generate',
                ['uses' => 'PasswordController@generate', 'as' => 'admin.password.generate']);


            Route::resource('account', 'AccountController', [
                'names' => [
                    'edit'   => 'admin.account.edit',
                    'update' => 'admin.account.update',
                ]
            ]);

            Route::resource(
                'role',
                'RoleController',
                [
                    'only'  => ['edit', 'update'],
                    'names' => [
                        'edit'   => 'admin.role.edit',
                        'update' => 'admin.role.update',
                    ]
                ]
            );
        });

        Route::resource('roles', 'RoleController', [
            'names' => [
                'index'   => 'admin.roles.index',
                'create'  => 'admin.roles.create',
                'store'   => 'admin.roles.store',
                'show'    => 'admin.roles.show',
                'edit'    => 'admin.roles.edit',
                'update'  => 'admin.roles.update',
                'destroy' => 'admin.roles.destroy'
            ]
        ]);
    });
