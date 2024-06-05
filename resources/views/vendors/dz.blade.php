@push('extended-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/file-uploaders/dropzone.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-file-uploader.css') }}">
@endpush

@push('extended-js')
    <script src="{{ asset('app-assets/vendors/js/file-uploaders/dropzone.min.js') }}"></script>
    {{-- <script src="{{ asset('app-assets/js/scripts/forms/form-file-uploader.js') }}"></script> --}}
@endpush
