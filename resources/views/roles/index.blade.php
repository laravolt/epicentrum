@extends(config('modules.users.view.layout'))
@section('content')
    <div class="ui container">
        <div class="ui grid two column">
            <div class="column"><h2 class="ui header">@lang('roles.roles')</h2></div>
            <div class="column right aligned"><a href="{{ route('admin.roles.create') }}" class="ui button primary"><i class="icon plus"></i> Tambah</a></div>
        </div>
        <div class="ui grid">
            <div class="column sixteen wide">
                <div class="ui cards four">
                    @foreach($roles as $role)
                    <div class="ui card">
                        <div class="content">
                            <h3 class="header">{{ $role['name'] }}</h3>
                        </div>
                        <div class="extra content">
                            <span class="ui label basic"><i class="icon users"></i>{{ $role->users->count() }}</span>
                            <span class="right floated ui label basic"><i class="icon options"></i> {{ $role->permissions->count() }}</span>
                        </div>
                        <div class="extra content">
                            <a href="{{ route('admin.roles.edit', $role['id']) }}" class="ui button fluid">Edit</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
