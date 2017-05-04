@extends(config('laravolt.epicentrum.view.layout'))

@section('content')

    <div class="ui grid two column">
        <div class="column"><h2 class="ui header">@lang('epicentrum::label.users')</h2></div>
        <div class="column right aligned"><a href="{{ route('epicentrum::users.create') }}" class="ui button primary"><i class="icon plus"></i> @lang('epicentrum::action.add')</a></div>
    </div>

    <div class="ui divider hidden"></div>

    {!! Suitable::source($users)
    ->columns([
        //new \Laravolt\Suitable\Columns\Checkall(),
        ['header' => trans('epicentrum::users.name'), 'raw' => function($data){
            return "<img class='ui image avatar' src='" . Laravolt\Avatar\Facade::create($data->name)->toBase64() . "'>" . " " . $data->name;
        }],
        ['header' => trans('epicentrum::users.email'), 'field' => 'email'],
        ['header' => trans('epicentrum::users.roles'), 'raw' => function($data){
            return $data->roles->implode('name', ', ');
        }],
        ['header' => trans('epicentrum::users.status'), 'raw' => function($data){
            return sprintf('<div class="ui label basic mini">%s</div>', $data->getStatusLabel());
        }],
        ['header' => trans('epicentrum::users.registered_at'), 'raw' => function($data){
            return sprintf('%s', $data->created_at->format('j F Y'));
        }],
        ['header' => false, 'raw' => function($data){
            return "<a class='ui button mini' href='".route('epicentrum::users.edit', $data->id)."'>".trans('epicentrum::action.edit')."</a>";
        }],
    ])
    ->render() !!}

@endsection
