@extends(config('laravolt.epicentrum.view.layout'))

@section('content')

    <div class="ui grid two column">
        <div class="column"><h2 class="ui header">@lang('epicentrum::label.users')</h2></div>
        <div class="column right aligned"><a href="{{ route('epicentrum::users.create') }}" class="ui button primary"><i
                        class="icon plus"></i> @lang('epicentrum::action.add')</a></div>
    </div>

    <div class="ui divider hidden"></div>

    {!! $table !!}
@endsection
