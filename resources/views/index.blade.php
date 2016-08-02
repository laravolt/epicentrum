@extends(config('epicentrum.view.layout'))

@section('content')

    {!! Suitable::source($users)
    ->title(trans('epicentrum::users.pages.index.header'))
    //->addToolbar('With Selected:')
    //->addToolbar(render('packages.suitable.delete'))
    ->columns([
        new \Laravolt\Suitable\Columns\Checkall(),
        ['header' => trans('epicentrum::users.name'), 'raw' => function($data){
            return "<img class='ui image avatar' src='" . $data->present('avatar') . "'>" . " " . $data->present('name');
        }],
        ['header' => trans('epicentrum::users.email'), 'field' => 'email'],
        ['header' => false, 'raw' => function($data){
            return "<a href='".route('epicentrum::users.edit', $data->id)."'><i class='icon setting'></i></a>";
        }],
    ])
    ->render() !!}

@endsection
