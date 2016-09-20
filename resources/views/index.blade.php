@extends(config('laravolt.epicentrum.view.layout'))

@section('content')

    {!! Suitable::source($users)
    ->title(trans('epicentrum::users.pages.index.header'))
    ->columns([
        new \Laravolt\Suitable\Columns\Checkall(),
        ['header' => trans('epicentrum::users.name'), 'raw' => function($data){
            return "<img class='ui image avatar' src='" . Laravolt\Avatar\Facade::create($data->name)->toBase64() . "'>" . " " . $data->name;
        }],
        ['header' => trans('epicentrum::users.email'), 'field' => 'email'],
        ['header' => trans('epicentrum::users.status'), 'field' => 'status'],
        ['header' => false, 'raw' => function($data){
            return "<a href='".route('epicentrum::users.edit', $data->id)."'><i class='icon setting'></i></a>";
        }],
    ])
    ->render() !!}

@endsection
