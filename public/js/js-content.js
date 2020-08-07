(function ($) {
    $('.js-content > iframe').each(function () {
        var $this = $(this);
        var p = $('<p>', {class: 'desc-video-container'});
        p.insertBefore($this);
        p.html($this.remove());
        $this.addClass('desc-video');
    });

    $('p > iframe').each(function () {
        $(this).addClass('desc-video');
        $(this).parent().addClass('desc-video-container');
    });

    $('.js-content p').each(function () {
        if ($(this).find('img').length > 0) {

        }
    });
})(jQuery);
