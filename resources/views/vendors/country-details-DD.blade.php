{{-- Include it in extended js stack --}}
@push('extended-js')
    <script>
        // init
        let GET_STATES_ENDPOINT = '{{ route('guest.get-states2') }}';
        let GET_CITIES_ENDPOINT = '{{ route('guest.get-cities2') }}';
        let GET_ZIP_ENDPOINT = '{{ route('guest.get-zip2') }}';
    </script>

    <script src="{{ asset('assets/js/custom/countryDetails.js') }}"></script>
@endpush
