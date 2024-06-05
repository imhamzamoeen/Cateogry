@extends('layouts.app')
@include('theme_include.select')
@include('theme_include.toaster')
@include('theme_include.data_table')
@push('extended-css')

@endpush

@section('content')


<livewire:user-managment-blade-component />

@endsection

@push('extended-js')


@endpush