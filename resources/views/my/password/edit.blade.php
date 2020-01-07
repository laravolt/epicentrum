@extends(config('laravolt.epicentrum.view.layout'))

@section('content')

    @component('ui::components.panel', ['title' => __('Edit Password')])
        {!! form()->open()->action(route('epicentrum::my.password.update'))->horizontal() !!}
        {!! form()->password('password_current')->label(__('epicentrum::users.password_current')) !!}
        {!! form()->password('password')->label(__('epicentrum::users.password_new')) !!}
        {!! form()->password('password_confirmation')->label(__('epicentrum::users.password_new_confirmation')) !!}
        {!! form()->action(form()->submit(__('epicentrum::action.save'))) !!}
        {!! form()->close() !!}
    @endcomponent
@endsection
