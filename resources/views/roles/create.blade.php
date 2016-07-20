@extends(config('epicentrum.view.layout'))

@section('content')
    <div class="ui segment very padded">

        <h2 class="ui header"><span>Tambah</span> Role</h2>

        {!! SemanticForm::open()->post()->action(route('epicentrum.roles.store')) !!}
        {!! SemanticForm::text('name', old('name'))->label(trans('epicentrum::roles.name'))->required() !!}

        <table class="ui table">
            <thead>
            <tr>
                <th>
                    <div class="ui checkbox" data-toggle="checkall" data-selector=".checkbox[data-type='check-all-child']">
                        <input type="checkbox">
                        <label><strong>Hak Akses</strong></label>
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($permissions as $permission)
                <tr>
                    <td>
                        <div class="ui checkbox" data-type="check-all-child">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" {{ (false)?'checked=checked':'' }}>
                            <label>{{ $permission->name }}</label>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="ui divider hidden"></div>

        <button class="ui button primary" type="submit" name="submit" value="1">@lang('epicentrum::action.save')</button>
        <a href="{{ route('epicentrum.roles.index') }}" class="ui button">@lang('epicentrum::action.cancel')</a>
        {!! SemanticForm::close() !!}

    </div>
@endsection
