@extends(config('laravolt.epicentrum.view.layout'))
@section('content')


    <div class="ui menu top attached">
        <a href="{{ route('epicentrum::users.index') }}" class="item"><i class="icon angle left"></i> @lang('epicentrum::action.back')</a>
    </div>
    <div class="ui segment p-0 bottom attached secondary">
        <div class="p-1">
            <div class="ui list horizontal">
                <div class="item">
                    <h3 class="ui header">
                        <img class="ui image avatar" src="{{ $user->present('avatar') }}" alt=""> {{ $user->present('name') }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="ui tabular menu left attached">
            <a class="item {{ ($tab == 'account')?'active':'' }}" href="{{ route('epicentrum::account.edit', $user['id']) }}">@lang('epicentrum::menu.account')</a>
            <a class="item {{ ($tab == 'password')?'active':'' }}" href="{{ route('epicentrum::password.edit', $user['id']) }}">@lang('epicentrum::menu.password')</a>
            {{--<a class="item {{ ($tab == 'role')?'active':'' }}" href="{{ route('epicentrum::role.edit', $user['id']) }}">@lang('epicentrum::menu.role')</a>--}}
        </div>
        <div class="ui segment bottom attached p-1 b-0" data-tab="first">
            @yield('content-user-edit')
        </div>
    </div>
@endsection
