$(function () {
    populateForElse();
});

function addLoader(className, msg) {
    $("." + className).prop("disabled", true);
    $("." + className + "-inner").html(msg);
    $("." + className + "-spinner").show();
}

function removeLoader2(className, msg) {
    $("." + className).prop("disabled", false);
    $("." + className + "-inner").html(msg);
    $("." + className + "-spinner").hide();
}

function validationPrint(response, errorsClassName, loaderClass, loaderClassMsg) {
    var showHideErrors = $("." + errorsClassName);
    var html =
        '<div class="mb-4">' +
        "<strong>Whoops! Something went wrong.</strong>" +
        '<ul class="mt-1 list-disc list-inside text-sm text-danger ul-class">';
    $.each(
        response.responseJSON.errors,
        function (indexInArray, valueOfElement) {
            makeToaster(
                "error",
                "😥 Oops! Something went wrong !",
                valueOfElement
            );
            html += "<li>" + valueOfElement + "</li>";
        }
    );
    html += "</ul></div>";
    errorFlow2(showHideErrors, html);
    removeLoader2(loaderClass, loaderClassMsg);
}

function errorFlow2(element, html) {
    element
        .addClass("text-danger")
        .removeClass("text-center text-white badge bg-success");
    element.html(html);
    element.fadeIn("slow");
}

function successFlow2(errorsClassName, html) {
    var element = $("." + errorsClassName);

    element
        .removeClass("text-danger")
        .addClass("text-center text-white badge bg-success");
    element.html(
        '<p class="mt-1"><strong class="h4 text-white">' +
        html +
        " 😉</strong></p>"
    );
    element.fadeIn("slow");
    element.css("display", "block");
    setTimeout(() => {
        element.fadeOut("slow");
    }, 3000);
}

function successMessage(response, loaderClass, loaderClassMsg) {
    makeToaster("success", "😃 Yeepii! Successful !", response.response);
    removeLoader2(loaderClass, loaderClassMsg);
}

function exceptionErrorHandling(errorsClassName, response, loaderClass, loaderClassMsg) {
    var showHideErrors = $("." + errorsClassName);
    showHideErrors.html("");
    makeToaster(
        "error",
        "😧 " + response.responseJSON.message,
        "Oops! " + response.responseJSON.response + " !"
    );
    removeLoader2(loaderClass, loaderClassMsg);
}

// function for jquery reload a div after some addition or deletion on server
function refreshDivByid(elementId) {
    $('#' + elementId).load(' #' + elementId);
}

// function for jquery reload a div after some addition or deletion on server
function refreshDivByClass(elementClass) {
    $("." + elementClass).load(' #' + elementClass);
}

function populateForElse() {
    $(".forelse").html(
        '<div class="alert alert-info" role="alert"><h4 class="alert-heading">Info</h4><div class="alert-body">No information available 😥</div></div>'
    );
}

function refreshNotficationDivs() {
    refreshDivByid("notifyPill1")
    refreshDivByid("notifyPill2")
    refreshDivByid("notifications")
}

function FailedToasterResponse(response) {
    // console.log(response);
    if (response.status == 409) {
        toastr["error"](response.responseJSON.response, response.responseJSON.message, {
            closeButton: true,
            tapToDismiss: false,
            progressBar: true,
            // rtl: isRtl,
        });
    } else if (response.status == 403) {
        toastr["warning"](response.responseJSON.message, 'Unauthorized', {
            closeButton: true,
            tapToDismiss: false,
            progressBar: true,
            // rtl: isRtl,
        });
    } else {
        $.each(response.responseJSON.errors, function (key, name) {
            toastr["error"](name, key, {
                closeButton: true,
                tapToDismiss: false,
                progressBar: true,
                // rtl: isRtl,
            });
        });
    }

}

function toaster(type, message, heading) {
    toastr[type](message, heading, {
        closeButton: true,
        tapToDismiss: false,
        progressBar: true,
    });
}


function swal_ask(title, text, icon, confirmtext, canceltitle, canceltext, cancelicon, sucecssfunction, parameter1, parameter2, parameter3, parameter4, parameter5) {

    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: true,
        confirmButtonText: confirmtext,
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-outline-danger ms-1'
        },
        buttonsStyling: false
    }).then(function (result) {
        if (result.value) {

            toastr["info"]("We are processing your request !", "👋 Please wait ...", {
                closeButton: true,
                tapToDismiss: false,
                progressBar: true,
            });

            window[sucecssfunction](parameter1, parameter2, parameter3, parameter4, parameter5);



        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: canceltitle,
                text: canceltext,
                icon: cancelicon,
                customClass: {
                    confirmButton: 'btn btn-success'
                }
            });

        }
    });

}

function Select2Reinitalize() {

    var select = $('.select2');
    select.each(function () {
        var $this = $(this);
        $this.wrap('<div class="position-relative"></div>');
        $this.select2({
            dropdownAutoWidth: true,
            width: '100%',
            dropdownParent: $this.parent(),
            tags: true
        });
    });
    // $('.select2').select2();
}
