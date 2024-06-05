@extends('layouts.app')
@include('theme_include.select')
@include('theme_include.toaster')
@include('theme_include.data_table')
@push('extended-css')
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
@endpush

@section('content')



<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">Orders</h4>
            </div>

            <hr class="my-0" />
            <div class="card-datatable">
                <livewire:order-table/>
            </div>
        </div>
    </div>
</div>


@endsection

@push('extended-js')


@endpush