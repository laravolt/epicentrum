@extends(config('epicentrum.view.layout'))
@section('content')
    <div class="ui container">
        <div class="ui segment very padded">

            <h3 class="ui header">Tambah Pengguna</h3>

            {!! SemanticForm::open()->post()->action(route('epicentrum.users.store')) !!}
            {!! SemanticForm::text('name', old('name'))->label(trans('users.name'))->required() !!}
            {!! SemanticForm::text('email', old('email'))->label(trans('users.email'))->required() !!}

            <div class="field required">
                <label>@lang('users.password')</label>
                <div class="ui right labeled input">
                    {!! SemanticForm::text('password', old('password'))->id('password') !!}
                    <button class="ui label" type="button" onclick="document.getElementById('password').setAttribute('value', Math.random().toString(36).substr(2,8))">Generate</button>
                </div>
            </div>

            {!! SemanticForm::checkboxGroup('roles', $roles)->label('Role') !!}

            <div class="field required">
                <label>@lang('users.status')</label>
                {!! SemanticForm::select('status', $statuses, old('status')) !!}
            </div>

            <div class="ui divider hidden"></div>
            <div class="field">
                <div class="ui checkbox">
                    <input type="checkbox" name="send_account_information" {{ request()->old('send_account_information')?'checked':'' }}>
                    <label>@lang('users.send_account_information_via_email')</label>
                </div>
            </div>
            <div class="field">
                <div class="ui checkbox">
                    <input type="checkbox" name="must_change_password" {{ request()->old('must_change_password')?'checked':'' }}>
                    <label>@lang('password::password.change_password_on_first_login')</label>
                </div>
            </div>
            <div class="ui divider hidden"></div>

            <button class="ui button primary" type="submit" name="submit" value="1">@lang('button.save')</button>
            <a href="{{ route('epicentrum.users.index') }}" class="ui button">@lang('button.cancel')</a>
            {!! SemanticForm::close() !!}

        </div>
    </div>
@endsection
