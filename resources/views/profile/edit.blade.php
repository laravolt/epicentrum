@extends('epicentrum::edit', ['tab' => 'profile'])

@section('content-user-edit')
    {!! SemanticForm::open()->put()->action(route('epicentrum.profile.update', $user['id'])) !!}

    <div class="field">
        <label>@lang('epicentrum::users.bio')</label>
        {!! SemanticForm::textarea('bio', old('bio', $profile['bio']))->rows(3) !!}
    </div>

    <div class="field">
        <label>@lang('epicentrum::users.timezone')</label>
        {!! SemanticForm::select('timezone', $timezones, old('timezone', $profile['timezone'])) !!}
    </div>

    <div class="ui divider hidden"></div>
    <button class="ui button primary" type="submit" name="submit" value="1">@lang('epicentrum::action.save')</button>
    <a href="{{ route('epicentrum.users.index') }}" class="ui button">@lang('epicentrum::action.cancel')</a>
    {!! SemanticForm::close() !!}
@endsection
