@extends(config('laravolt.epicentrum.view.layout'))

@section('content')

    @component('ui::components.panel', ['title' => __('Edit Profil')])
        {!! form()->bind($user)->put(route('epicentrum::my.profile.update'))->horizontal() !!}

        {!! form()->text('name')->label(__('epicentrum::users.name')) !!}
        {!! form()->text('email')->label(__('epicentrum::users.email'))->readonly() !!}
        {!! form()->dropdown('timezone', $timezones)->label(__('epicentrum::users.timezone')) !!}

        {!! form()->action(form()->submit(__('epicentrum::action.save'))) !!}
        {!! form()->close() !!}
    @endcomponent
@endsection
