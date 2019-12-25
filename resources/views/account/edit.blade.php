@extends('epicentrum::edit', ['tab' => 'account'])

@section('content-user-edit')
    {!! form()->bind($user)->open()->put()->action(route('epicentrum::account.update', $user['id'])) !!}

    {!! form()->text('name')->label(__('epicentrum::users.name')) !!}
    {!! form()->text('email')->label(__('epicentrum::users.email')) !!}
    {!! form()->dropdown('status', $statuses)->label(__('epicentrum::users.status')) !!}
    {!! form()->dropdown('timezone', $timezones)->label(__('epicentrum::users.timezone')) !!}

    <div class="ui segments">
        <div class="ui segment">
            <div class="grouped fields">
                <label>@lang('epicentrum::users.roles')</label>
                @foreach($roles as $role)
                    <div class="field {{ $roleEditable ? '' : 'disabled' }}">
                        <div class="ui checkbox {{ $multipleRole?'':'radio' }}">
                            <input type="{{ $multipleRole?'checkbox':'radio' }}" name="roles[]"
                                   value="{{ $role->id }}" {{ ($user->hasRole($role))?'checked=checked':'' }}>
                            <label>{{ $role->name }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @unless($roleEditable)
            <div class="ui secondary segment">

                <span class="ui grey text"><i>Editing role are disabled by system</i></span>
            </div>
        @endif
    </div>

    {!! form()->action(form()->submit(__('epicentrum::action.save')), form()->link(__('epicentrum::action.back'), route('epicentrum::users.index'))) !!}
    {!! form()->close() !!}


    <div class="ui divider section"></div>

    <div class="ui red segment p-1">
        <h3>@lang('epicentrum::users.delete_account')</h3>

        @if($user['id'] == auth()->id())
            <div class="ui message warning">@lang('epicentrum::message.cannot_delete_yourself')</div>
        @else
            {!! form()->open()->delete()->action(route('epicentrum::users.destroy', $user['id'])) !!}
            <p>Menghapus pengguna dan semua data yang berhubungan dengan pengguna ini.
                <br>
                Aksi ini tidak bisa dibatalkan.</p>
            <button class="ui button red" type="submit" name="submit" value="1"
                    onclick="return confirm('@lang('epicentrum::message.account_deletion_confirmation')')">@lang('epicentrum::action.delete')</button>
            {!! form()->close() !!}
        @endif
    </div>

@endsection
