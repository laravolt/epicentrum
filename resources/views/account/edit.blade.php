@extends('epicentrum::edit', ['tab' => 'account'])

@section('content-user-edit')
    {!! SemanticForm::open()->put()->action(route('epicentrum.account.update', $user['id'])) !!}

    <div class="field">
        <label>@lang('epicentrum::users.name')</label>
        {!! SemanticForm::text('name', old('name', $user['name'])) !!}
    </div>
    <div class="field">
        <label>@lang('epicentrum::users.email')</label>
        {!! SemanticForm::text('email', old('email', $user['email'])) !!}
    </div>
    <div class="field">
        <label>@lang('epicentrum::users.status')</label>
        {!! SemanticForm::select('status', $statuses, old('status', $user['status'])) !!}
    </div>

    <div class="ui divider hidden"></div>

    <button class="ui button primary" type="submit" name="submit" value="1">@lang('epicentrum::action.save')</button>
    <a href="{{ route('epicentrum.users.index') }}" class="ui button">@lang('epicentrum::action.cancel')</a>
    </div>
    {!! SemanticForm::close() !!}

    <div class="ui divider"></div>

    <div class="ui basic segment">
        <h3>Hapus Akun</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid aperiam autem delectus ea earum error et ex, facere, labore, laudantium magnam minus officia perferendis provident quae quam quo temporibus voluptate.</p>

        {!! SemanticForm::open()->delete()->action(route('epicentrum.users.destroy', $user['id'])) !!}

        <button class="ui button red" type="submit" name="submit" value="1">@lang('epicentrum::button.delete')</button>
        {!! SemanticForm::close() !!}
    </div>

@endsection
