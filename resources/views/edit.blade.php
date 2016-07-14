@extends(config('epicentrum.view.layout'))
@section('content')
    <div class=" ui grid centered stackable">
        <div class="ten wide column">

            <div class="ui segment very padded">
                <h3 class="ui header"><img class="ui image avatar" src="{{ $user->present('avatar') }}" alt=""> {{ $user->present('name') }}</h3>
                <div class="ui divider hidden"></div>
                <div class="ui tabular menu top attached four item">
                    <a class="item {{ (request()->segment(3) == 'profile')?'active':'' }}" href="{{ route('epicentrum.profile.edit', $user['id']) }}">@lang('users.menu.profile')</a>
                    <a class="item {{ (request()->segment(3) == 'account')?'active':'' }}" href="{{ route('epicentrum.account.edit', $user['id']) }}">@lang('users.menu.account')</a>
                    <a class="item {{ (request()->segment(3) == 'password')?'active':'' }}" href="{{ route('epicentrum.password.edit', $user['id']) }}">@lang('users.menu.password')</a>
                    <a class="item {{ (request()->segment(3) == 'role')?'active':'' }}" href="{{ route('epicentrum.role.edit', $user['id']) }}">@lang('users.menu.role')</a>
                </div>
                <div class="ui segment bottom attached" data-tab="first">
                    <div class="ui segment basic padded">
                        @yield('content-user-edit')
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
