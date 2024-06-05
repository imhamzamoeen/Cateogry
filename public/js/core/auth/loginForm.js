// check login info

$("#LoginForm").submit(function (e) {
    e.preventDefault();

    if ($(this).valid()) {

        $(this).find(":submit").attr('disabled', true);

        toastr['info'](
            'Please wait while we redirect...',
            'Verification 🆗', {
            closeButton: true,
            tapToDismiss: false,
            rtl: false
        });
        setTimeout(() => {
            this.submit()
        }, 1000);
    }
});
