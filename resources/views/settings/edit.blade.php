@extends('admin')

@section('content')
    <div >
        <h3>Edit Setting</h3>
        <a href="{{ route('admin.setting.index') }}" class="btn btn-success my-1">
                Home
        </a>
        @include('settings/settingForm', ['setting' => $setting])
    </div>
@endsection