@extends('layouts.app')

@section('content')

@include('partials.header')

<div class="container mx-auto px-4 md:px-0 font-sans">
    @include('dashboard.datasets')

    @include('dashboard.credentials')

    @admin
        @include('dashboard.control')
        @include('dashboard.users')
    @else
        @include('partials.help')
    @endadmin

    @include('partials.alert')
</div>

@endsection
