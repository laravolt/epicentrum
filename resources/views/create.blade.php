@extends(config('laravolt.epicentrum.view.layout'))
@section('content')
    <div class="ui menu top attached">
        <a href="{{ route('epicentrum::users.index') }}" class="item">
            <i class="icon angle left"></i>
        </a>
        <h3 class="ui header item">@lang('epicentrum::menu.add_user')</h3>
    </div>

    <div class="ui segment very padded bottom attached">
        {!! SemanticForm::open()->post()->action(route('epicentrum::users.store')) !!}
        {!! SemanticForm::text('name', old('name'))->label(trans('epicentrum::users.name'))->required() !!}
        {!! SemanticForm::text('email', old('email'))->label(trans('epicentrum::users.email'))->required() !!}

        <div class="field required">
            <label>@lang('epicentrum::users.password')</label>
            <div class="ui action input">
                {!! SemanticForm::text('password', old('password'))->id('password') !!}
                <button class="ui button small" type="button" data-role="randomize-password">@lang('epicentrum::action.generate_password')</button>
            </div>
        </div>

        @if($multipleRole)
            {!! SemanticForm::checkboxGroup('roles', $roles)->label(trans('epicentrum::users.roles')) !!}
        @else
            {!! SemanticForm::radioGroup('roles', $roles)->label(trans('epicentrum::users.roles')) !!}
        @endif

        <div class="field required">
            <label>@lang('epicentrum::users.status')</label>
            {!! SemanticForm::select('status', $statuses, old('status')) !!}
        </div>

        <div class="ui divider hidden"></div>
        <div class="field">
            <div class="ui checkbox">
                <input type="checkbox" name="send_account_information" {{ request()->old('send_account_information')?'checked':'' }}>
                <label>@lang('epicentrum::users.send_account_information_via_email')</label>
            </div>
        </div>
        <div class="field">
            <div class="ui checkbox">
                <input type="checkbox" name="must_change_password" {{ request()->old('must_change_password')?'checked':'' }}>
                <label>@lang('epicentrum::users.change_password_on_first_login')</label>
            </div>
        </div>
        <div class="ui divider hidden"></div>

        <button class="ui button primary" type="submit" name="submit" value="1">@lang('epicentrum::action.save')</button>
        <a href="{{ route('epicentrum::users.index') }}" class="ui button">@lang('epicentrum::action.cancel')</a>
        {!! SemanticForm::close() !!}

    </div>
@endsection

@push('body')
<script>
    $(function(){
        $('[data-role="randomize-password"]').on('click', function(){
            document.getElementById('password').setAttribute('value', Math.random().toString(36).substr(2,8));
        });
    });
</script>
@endpush
