@extends(config('laravolt.epicentrum.view.layout'))

@section('page.title', __('epicentrum::label.users'))

@push('page.actions')
    <a href="{{ route('epicentrum::users.index') }}" class="ui button">
        <i class="icon arrow up"></i> Kembali ke Index
    </a>
@endpush

@section('content')
    @component('ui::components.panel', ['title' => __('epicentrum::menu.add_user')])
        {!! form()->open()->post()->action(route('epicentrum::users.store')) !!}
        {!! form()->text('name')->label(trans('epicentrum::users.name'))->required() !!}
        {!! form()->text('email')->label(trans('epicentrum::users.email'))->required() !!}
        {!! form()->input('password')->appendButton(trans('epicentrum::action.generate_password'), 'randomize')->label(trans('epicentrum::users.password'))->required() !!}

        @if($multipleRole)
            {!! form()->checkboxGroup('roles', $roles)->label(trans('epicentrum::users.roles')) !!}
        @else
            {!! form()->radioGroup('roles', $roles)->label(trans('epicentrum::users.roles')) !!}
        @endif

        {!! form()->select('status', $statuses)->label(__('epicentrum::users.status')) !!}
        {!! form()->select('timezone', $timezones, config('app.timezone'))->label(__('epicentrum::users.timezone')) !!}

        <div class="ui divider section"></div>

        {!! form()->checkbox('send_account_information', 1)->label(__('epicentrum::users.send_account_information_via_email')) !!}
        {!! form()->checkbox('must_change_password', 1)->label(__('epicentrum::users.change_password_on_first_login')) !!}

        <div class="ui divider section"></div>

        {!! form()->action(form()->submit(__('epicentrum::action.save')), form()->link(__('epicentrum::action.back'), route('epicentrum::users.index'))) !!}
        {!! form()->close() !!}

    @endcomponent

@endsection


@push('body')
    <script>
      $(function () {
        $('.randomize').on('click', function (e) {
          $(e.currentTarget).prev().val(Math.random().toString(36).substr(2, 8));
        });
      });
    </script>
@endpush
