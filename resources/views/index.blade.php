@extends(config('epicentrum.view.layout'))

@section('content')
    <div class="ui container">

        <div class="ui top attached segment secondary">
            <div class="ui grid two column">
                <div class="column middle aligned">
                    <h3 class="ui header">@lang('epicentrum::users.pages.index.header')</h3>
                </div>
                <div class="column right aligned">
                    <a href="{{ route('epicentrum.users.create') }}" class="ui button primary pull-right"><i class="icon plus"></i> Tambah</a>
                </div>
            </div>
        </div>

        <div class="ui attached menu">
            <div class="menu">
                <div class="item borderless">
                    <small>{!! sui_pagination($users)->summary() !!}</small>
                </div>
            </div>
            <div class="right menu">
                <div class="ui right aligned item">
                    <form action="">
                        <div class="ui transparent icon input">
                            <input class="prompt" name="search" value="{{ request('search') }}" type="text" placeholder="@lang('epicentrum::users.action.search')">
                            <i class="search link icon"></i>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="ui segment attached fitted">
            <table class="ui very compact table bottom small sortable">
                <thead>
                <tr>
                    <th>@lang('epicentrum::users.name')</th>
                    <th>@lang('epicentrum::users.email')</th>
                    <th>@lang('epicentrum::users.status')</th>
                    <th>@lang('epicentrum::users.registered_at')</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>
                            <img src="{{ $user->present('avatar') }}" alt="" class="ui image avatar">{{ $user->present('name') }}
                        </td>
                        <td>{{ $user->present('email') }}</td>
                        <td>{{ $user->present('status') }}</td>
                        <td>{{ $user->present('registered_at') }}</td>
                        <td class="right aligned">
                            <a href="{{ route('epicentrum.users.edit', $user['id']) }}" class="ui button basic mini">@lang('epicentrum::users.action.manage')</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="warning center aligned" style="font-size: 1.5rem;padding:40px;font-style: italic">Data tidak tersedia</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="ui menu bottom attached">
            <div class="item borderless">
                <small>{!! sui_pagination($users)->pager() !!}</small>
            </div>
            {!! sui_pagination($users->appends(['search' => request('search')]))->render('attached bottom right') !!}
        </div>
    </div>
@endsection
