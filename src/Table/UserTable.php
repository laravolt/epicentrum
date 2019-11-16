<?php

namespace Laravolt\Epicentrum\Table;

use Laravolt\Suitable\Columns\Avatar;
use Laravolt\Suitable\Columns\Date;
use Laravolt\Suitable\Columns\Label;
use Laravolt\Suitable\Columns\Numbering;
use Laravolt\Suitable\Columns\Raw;
use Laravolt\Suitable\Columns\RestfulButton;
use Laravolt\Suitable\Columns\Text;
use Laravolt\Suitable\TableView;

class UserTable extends TableView
{
    protected function columns()
    {
        return [
            Numbering::make('No'),
            Avatar::make('name', ''),
            Text::make('name', trans('epicentrum::users.name'))->sortable(),
            Text::make('username', trans('epicentrum::users.username'))->sortable(),
            Text::make('email', trans('epicentrum::users.email'))->sortable(),
            Raw::make(
                function ($data) {
                    return $data->roles->implode('name', ', ');
                },
                trans('epicentrum::users.roles')
            ),
            Label::make('status', trans('epicentrum::users.status')),
            Date::make('created_at', trans('epicentrum::users.registered_at'))->sortable(),
            RestfulButton::make('epicentrum::users', trans('epicentrum::users.action'))->only('edit', 'delete'),
        ];
    }
}
