$(document).on('mouseup', function (e) {
    var selection = window.getSelection().toString();

    if (e.target.closest('.js-corrections')) {
        return;
    }

    if (selection.length > 0) {
        var modal = $('.js-corrections');
        $('.js-corrections-from').text(selection);
        $('input[name="correction_from"]').val(selection);
        $('input[name="correction_url"]').val(window.location.href);

        modal.modal();
    }
});

$('.js-corrections-form').on('submit', function (e) {
    e.preventDefault();
    var $this = $(this);
    var data = new FormData($this[0]);

    $.ajax({
        url: $this.attr('action'),
        type: 'POST',
        data: data,
        processData: false,
        cache: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        success: function () {
            $('.js-corrections').modal('hide');
        },
        error: function (e) {
            console.error(e);
        }
    });
});
