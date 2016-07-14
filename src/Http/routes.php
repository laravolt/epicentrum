<?php

Route::group(
    [
        'namespace'  => '\Laravolt\Epicentrum\Http\Controllers',
        'prefix'     => 'epicentrum',
        'middleware' => ['web', 'auth']
    ],
    function () {

        Route::group(['namespace' => 'User'], function(){

            Route::resource('users', 'UserController', [
                'names' => [
                    'index'   => 'epicentrum.users.index',
                    'create'  => 'epicentrum.users.create',
                    'store'   => 'epicentrum.users.store',
                    'show'    => 'epicentrum.users.show',
                    'edit'    => 'epicentrum.users.edit',
                    'update'  => 'epicentrum.users.update',
                    'destroy' => 'epicentrum.users.destroy'
                ]
            ]);

            Route::resource('profile', 'ProfileController', [
                'names' => [
                    'index'   => 'epicentrum.profile.index',
                    'create'  => 'epicentrum.profile.create',
                    'store'   => 'epicentrum.profile.store',
                    'show'    => 'epicentrum.profile.show',
                    'edit'    => 'epicentrum.profile.edit',
                    'update'  => 'epicentrum.profile.update',
                    'destroy' => 'epicentrum.profile.destroy'
                ]
            ]);

            Route::resource('password', 'PasswordController', [
                'names' => [
                    'edit' => 'epicentrum.password.edit',
                ]
            ]);
            Route::post('password/{id}/reset', ['uses' => 'PasswordController@reset', 'as' => 'epicentrum.password.reset']);
            Route::post('password/{id}/generate',
                ['uses' => 'PasswordController@generate', 'as' => 'epicentrum.password.generate']);


            Route::resource('account', 'AccountController', [
                'names' => [
                    'edit'   => 'epicentrum.account.edit',
                    'update' => 'epicentrum.account.update',
                ]
            ]);

            Route::resource(
                'role',
                'RoleController',
                [
                    'only'  => ['edit', 'update'],
                    'names' => [
                        'edit'   => 'epicentrum.role.edit',
                        'update' => 'epicentrum.role.update',
                    ]
                ]
            );
        });

        Route::resource('roles', 'RoleController', [
            'names' => [
                'index'   => 'epicentrum.roles.index',
                'create'  => 'epicentrum.roles.create',
                'store'   => 'epicentrum.roles.store',
                'show'    => 'epicentrum.roles.show',
                'edit'    => 'epicentrum.roles.edit',
                'update'  => 'epicentrum.roles.update',
                'destroy' => 'epicentrum.roles.destroy'
            ]
        ]);
    });
