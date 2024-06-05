@push('custom_script')
    

<script>
    window.onbeforeunload = function() {
        $.ajax({
            type: "post",
            url: '{{route('support.agent_available')}}',
            dataType: "json",
            success: function () {
            }
        });
        $.blockUI({
            message: '<div class="d-flex justify-content-center align-items-center"><p class="me-50 mb-0">Please wait...</p> <div class="spinner-grow spinner-grow-sm text-white" role="status"></div> </div>',
            css: {
                backgroundColor: 'transparent',
                color: '#fff',
                border: '0'
            },
            overlayCSS: {
                opacity: 0.5
            }
        });      
    }
 
</script>
@endpush