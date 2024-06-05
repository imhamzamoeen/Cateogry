@extends('layouts.app')
@include('theme_include.select')
@include('theme_include.toaster')
@include('theme_include.data_table')
@push('extended-css')

<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/nouislider.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/extensions/ext-component-sliders.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-ecommerce.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/ui-feather.css')}}">

<!-- form wizard -->
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/wizard/bs-stepper.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-wizard.css') }}">

<!-- custom css for sponsered cards  -->
<link rel="stylesheet" type="text/css" href="{{asset('css/Sponsered_cards/sponsered_cards.css')}}">
@endpush

@section('content')


<livewire:store-blade-component />

@endsection

@push('extended-js')

<script src="{{asset('app-assets/js/scripts/pages/app-ecommerce.js')}}"></script>
<script src="{{ asset('app-assets/vendors/js/extensions/wNumb.min.js')}}"></script>
<script src="{{ asset('app-assets/vendors/js/extensions/nouislider.min.js')}}"></script>
<script src="{{asset('js/test_quote/find_quote_load.js')}}"></script>


<script src="{{asset('app-assets/js/scripts/ui/ui-feather.js')}}"></script>

<script src="{{asset('js/test_quote/filter_query.js')}}"></script>
<script src="{{asset('js/test_quote/filter_forms.js')}}"></script>
<script src="{{asset('js/test_quote/ajax_pagination.js')}}"></script>
<script src="{{asset('js/dynamic_ajax.js')}}"></script>
<script>
   feather.replace();
</script>
   
<!-- form wizard -->
<script src="{{ asset('app-assets/js/scripts/forms/form-wizard.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/wizard/bs-stepper.min.js') }}"></script>
  

<!-- touchspin -->
<script src="{{asset('app-assets/js/scripts/forms/form-number-input.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')}}"></script>

<!-- input mask woh us k number k lie  -->
<script src="{{asset('app-assets/js/scripts/forms/form-input-mask.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/forms/cleave/cleave.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/forms/cleave/addons/cleave-phone.us.js')}}"></script>


<!-- custom js for page -->
<script src="{{asset('js/test_quote/quote_finding_info_form_changing.js')}}"></script>
<script src="{{asset('js/test_quote/lead_generation_quote.js')}}"></script>

<script src="{{asset('js/test_quote/additional_option_change.js')}}"></script>
<script src="{{asset('js/test_quote/page_load.js')}}"></script>
<script src="{{asset('js/test_quote/global_function.js')}}"></script>



<script src="{{asset('js/test_quote/senior_hard_code.js')}}"></script>


@endpush