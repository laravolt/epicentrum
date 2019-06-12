@extends('ui::layouts.app')
@section('content')
    <h2 class="ui header">@lang('epicentrum::label.permissions')</h2>

    {!! form()->open(route('epicentrum::permissions.update'))->put() !!}

    {!! Suitable::source($permissions)->columns([
        \Laravolt\Suitable\Columns\Numbering::make('No')->setHeaderAttributes(['width' => '50px']),
        \Laravolt\Suitable\Columns\Text::make('name', __('epicentrum::permissions.name'))
            ->setHeaderAttributes(['width' => '250px']),
        \Laravolt\Suitable\Columns\Raw::make(function($item) {
            return SemanticForm::text('permission['.$item->getKey().']')->value($item->description);
        }, __('epicentrum::permissions.description'))
    ])->render() !!}

    <div class="ui divider hidden"></div>

    {!! form()->submit('Save') !!}
    {!! form()->close() !!}
@endsection
