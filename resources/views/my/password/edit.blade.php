@extends(config('laravolt.epicentrum.view.layout'))

@section('content')

    <h2 class="ui header">Edit Password</h2>
    {!! SemanticForm::open()->action(route('epicentrum::my.password.update')) !!}

    <div class="field">
        <label>@lang('epicentrum::users.password_current')</label>
        {!! SemanticForm::password('password_current') !!}
    </div>
    <div class="field">
        <label>@lang('epicentrum::users.password_new')</label>
        {!! SemanticForm::password('password') !!}
    </div>
    <div class="field">
        <label>@lang('epicentrum::users.password_new_confirmation')</label>
        {!! SemanticForm::password('password_confirmation') !!}
    </div>
    <div class="ui divider hidden"></div>

    <button class="ui button primary" type="submit" name="submit" value="1">@lang('epicentrum::action.save')</button>
    </div>
    {!! SemanticForm::close() !!}

@endsection
