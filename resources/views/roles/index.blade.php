@extends(config('epicentrum.view.layout'))

@section('content')
    <div class="ui segment very padded">
        <div class="ui grid two column">
            <div class="column"><h2 class="ui header">@lang('epicentrum::label.roles')</h2></div>
            <div class="column right aligned"><a href="{{ route('epicentrum.roles.create') }}" class="ui button basic primary"><i class="icon plus"></i> @lang('epicentrum::action.add')</a></div>
        </div>
        <div class="ui grid">
            <div class="column sixteen wide">
                <div class="ui cards three doubling">
                    @foreach($roles as $role)
                    <div class="ui card">
                        <div class="content">
                            <h3 class="header">{{ $role['name'] }}</h3>
                        </div>
                        <div class="extra content">
                            <i class="icon users"></i>{{ $role->users->count() }}
                            <span class="right floated"><i class="icon options"></i> {{ $role->permissions->count() }}</span>
                        </div>
                        <div class="extra content">
                            <a href="{{ route('epicentrum.roles.edit', $role['id']) }}" class="ui button fluid"><i class="icon setting"></i> @lang('epicentrum::action.manage')</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
