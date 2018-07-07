@extends('epicentrum::edit', ['tab' => 'account'])

@section('content-user-edit')
    {!! SemanticForm::open()->put()->action(route('epicentrum::account.update', $user['id'])) !!}

    <div class="field">
        <label>@lang('epicentrum::users.name')</label>
        {!! SemanticForm::text('name', old('name', $user['name'])) !!}
    </div>
    <div class="field">
        <label>@lang('epicentrum::users.email')</label>
        {!! SemanticForm::text('email', old('email', $user['email'])) !!}
    </div>

    <div class="grouped fields">
        <label>Role</label>
        @foreach($roles as $role)
            <div class="field">
                <div class="ui checkbox {{ $multipleRole?'':'radio' }}">
                    <input type="{{ $multipleRole?'checkbox':'radio' }}" name="roles[]" value="{{ $role->id }}" {{ ($user->hasRole($role))?'checked=checked':'' }}>
                    <label>{{ $role->name }}</label>
                </div>
            </div>
        @endforeach
    </div>

    <div class="field">
        <label>@lang('epicentrum::users.status')</label>
        {!! SemanticForm::select('status', $statuses, old('status', $user['status']))->addClass('search') !!}
    </div>
    <div class="field">
        <label>@lang('epicentrum::users.timezone')</label>
        {!! SemanticForm::select('timezone', $timezones, old('timezone', $user['timezone']))->addClass('search') !!}
    </div>

    <div class="ui divider hidden"></div>

    <button class="ui button primary" type="submit" name="submit" value="1">@lang('epicentrum::action.save')</button>
    <a href="{{ route('epicentrum::users.index') }}" class="ui button">@lang('epicentrum::action.cancel')</a>
    </div>
    {!! SemanticForm::close() !!}

    {{--<div class="ui divider"></div>--}}

    <div class="ui basic p-1 segment">
        <h3>@lang('epicentrum::users.delete_account')</h3>

        @if($user['id'] == auth()->id())
            <div class="ui message warning">@lang('epicentrum::message.cannot_delete_yourself')</div>
        @else
            {!! SemanticForm::open()->delete()->action(route('epicentrum::users.destroy', $user['id'])) !!}
            <button class="ui button red" type="submit" name="submit" value="1" onclick="return confirm('@lang('epicentrum::message.account_deletion_confirmation')')">@lang('epicentrum::action.delete')</button>
            {!! SemanticForm::close() !!}
        @endif
    </div>

@endsection
