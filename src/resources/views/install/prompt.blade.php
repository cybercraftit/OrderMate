@extends('ordermate::install.default')

@section('body')
    <install-prompt :routes='{
    get_users: "{{ route('ordermate.ajax.get_users') }}",
    install: "{{ route('ordermate.install.process') }}"
    }'></install-prompt>
@stop
@section('coremate_script_top')
    <script src="{{ asset('vendor/cybercraft/ordermate/js/ordermate-data.js') }}"></script>
@stop