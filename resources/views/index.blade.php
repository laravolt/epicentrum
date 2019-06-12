@extends(config('laravolt.epicentrum.view.layout'))

@section('content')

    <div class="ui grid two column">
        <div class="column"><h2 class="ui header">@lang('epicentrum::label.users')</h2></div>
        <div class="column right aligned"><a href="{{ route('epicentrum::users.create') }}" class="ui button primary"><i
                        class="icon plus"></i> @lang('epicentrum::action.add')</a></div>
    </div>

    <div class="ui divider hidden"></div>

    {!! Suitable::source($users)
    ->search(true)
    ->columns([
        \Laravolt\Suitable\Columns\Numbering::make('No'),
        \Laravolt\Suitable\Columns\Avatar::make('name', ''),
        \Laravolt\Suitable\Columns\Text::make('name', trans('epicentrum::users.name')),
        \Laravolt\Suitable\Columns\Text::make('email', trans('epicentrum::users.email')),
        \Laravolt\Suitable\Columns\Raw::make(
            function($data) {
                return $data->roles->implode('name', ', ');
            },
            trans('epicentrum::users.roles')
        ),
        \Laravolt\Suitable\Columns\Raw::make(
            function($data) {
                return sprintf('<div class="ui label basic mini">%s</div>', $data->getStatusLabel());
            },
            trans('epicentrum::users.status')
        ),
        \Laravolt\Suitable\Columns\Date::make('created_at', trans('epicentrum::users.registered_at')),
        \Laravolt\Suitable\Columns\RestfulButton::make('epicentrum::users')->only('edit', 'delete')
    ])
    ->render() !!}

@endsection
