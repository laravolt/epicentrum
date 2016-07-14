@extends('users::edit')

@section('content-user-edit')
    {!! SemanticForm::open()->put()->action(route('admin.account.update', $user['id'])) !!}

    <div class="field">
        <label>@lang('users.name')</label>
        {!! SemanticForm::text('name', old('name', $user['name'])) !!}
    </div>
    <div class="field">
        <label>@lang('users.email')</label>
        {!! SemanticForm::text('email', old('email', $user['email'])) !!}
    </div>
    <div class="field">
        <label>@lang('users.status')</label>
        {!! SemanticForm::select('status', $statuses, old('status', $user['status'])) !!}
    </div>

    <div class="ui divider hidden"></div>

    <button class="ui button primary" type="submit" name="submit" value="1">@lang('button.save')</button>
    <a href="{{ route('admin.users.index') }}" class="ui button">@lang('button.cancel')</a>
    </div>
    {!! SemanticForm::close() !!}

    <div class="ui divider"></div>

    <div class="ui basic segment">
        <h3>Hapus Akun</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid aperiam autem delectus ea earum error et ex, facere, labore, laudantium magnam minus officia perferendis provident quae quam quo temporibus voluptate.</p>

        {!! SemanticForm::open()->delete()->action(route('admin.users.destroy', $user['id'])) !!}

        <button class="ui button red" type="submit" name="submit" value="1">@lang('button.delete')</button>
        {!! SemanticForm::close() !!}
    </div>

@endsection
