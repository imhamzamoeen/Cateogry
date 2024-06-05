@extends('layouts.guest')
@include('theme_include.toaster')
@section('content')
<livewire:reset-password-blade-component :email="$user" />
@endsection
@push('extended-js')

@endpush