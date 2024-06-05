@extends('layouts.app')
@include('theme_include.select')
@include('theme_include.toaster')
@include('theme_include.data_table')
@push('extended-css')
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
@endpush

@section('content')


<livewire:unit-blade-component />

@endsection

@push('extended-js')


@endpush