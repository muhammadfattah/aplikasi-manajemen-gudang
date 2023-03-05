@extends('outlet::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('outlet.name') !!}
    </p>
@endsection
