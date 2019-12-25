@extends(config('laravolt.epicentrum.view.layout'))

@section('page.title', __('epicentrum::label.users'))

@push('page.actions')
    <a href="{{ route('epicentrum::users.create') }}" class="ui button primary">
        <i class="icon plus"></i> @lang('epicentrum::action.add')
    </a>
@endpush

@section('content')
    {!! $table !!}
@endsection
