$(function () {
    Livewire.on('toast', (type, message, heading) => {
        toaster(type, message, heading);
    });

    Livewire.on('ModalClose', (id) => {
        $('.' + id).modal('hide');

    });
    Livewire.on('RefreshForm', (id) => {
        $('.' + id).trigger('reset');
    });
    Livewire.on('ModalOpen', (id) => {
        $('.' + id).modal('show');

    });
});