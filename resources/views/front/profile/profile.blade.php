@extends('layouts.app')
@include('theme_include.select')
@include('theme_include.toaster')
@include('theme_include.data_table')
@push('extended-css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/page-profile.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/profile/change_profile.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">

@endpush

@section('content')


<livewire:profile-blade-component />

@endsection

@push('extended-js')

<script src="{{asset('js/global.js')}}"></script>
<script src="{{asset('js/dynamic_ajax.js')}}"></script>
@endpush