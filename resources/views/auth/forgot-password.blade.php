@extends('layouts.guest')
@include('theme_include.toaster')
@section('content')
<livewire:forget-password-blade-component />
@endsection
@push('extended-js')

@endpush