@extends(config('epicentrum.view.layout'))
@section('content')
    <div class="ui segment very padded">

        <div class="ui list horizontal">
            <div class="item">
                <a href="{{ route('epicentrum.users.index') }}" class="ui button basic"><i class="icon angle left"></i> @lang('epicentrum::action.back')</a>
            </div>
            <div class="item">
                <h3 class="ui header">
                    <img class="ui image avatar" src="{{ $user->present('avatar') }}" alt=""> {{ $user->present('name') }}
                </h3>
            </div>
        </div>

        <div class="ui divider section hidden"></div>

        <div class="ui tabular menu top attached four item">
            <a class="item {{ ($tab == 'profile')?'active':'' }}" href="{{ route('epicentrum.profile.edit', $user['id']) }}">@lang('epicentrum::users.menu.profile')</a>
            <a class="item {{ ($tab == 'account')?'active':'' }}" href="{{ route('epicentrum.account.edit', $user['id']) }}">@lang('epicentrum::users.menu.account')</a>
            <a class="item {{ ($tab == 'password')?'active':'' }}" href="{{ route('epicentrum.password.edit', $user['id']) }}">@lang('epicentrum::users.menu.password')</a>
            <a class="item {{ ($tab == 'role')?'active':'' }}" href="{{ route('epicentrum.role.edit', $user['id']) }}">@lang('epicentrum::users.menu.role')</a>
        </div>
        <div class="ui segment bottom attached" data-tab="first">
            <div class="ui segment basic padded">
                @yield('content-user-edit')
            </div>
        </div>
    </div>
@endsection
