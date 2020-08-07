(function ($) {
    var submited = false;

    function loadNewImages(url, data, success, error) {
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            processData: false,
            cache: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            success: success,
            error: error
        });
    }

    $('.summernote').summernote({
        tabsize: 2,
        height: 500,
        width: 1280,
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['add-text-tags']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['fontsize', 'color']],
            ['font', ['fontname']],
            ['para', ['paragraph']],
            ['insert', ['link','picture', 'video']], // image and doc are customized buttons
            ['misc', ['codeview']],
        ],
        callbacks: {
            onImageUpload: function (files) {
                var editor = $(this);
                var url = editor.data('image-url');
                var data = new FormData();
                data.append('file', files[0]);

                loadNewImages(url, data, function (res) {
                        editor.summernote('insertImage', res);
                        $('<input>', {
                            type: 'hidden',
                            name: 'images[]',
                            value: res,
                            class: 'new-image'
                        }).appendTo('.add-item-form');
                    }, function (error) {
                        console.log(error);
                    }
                );
            },
            onMediaDelete: function(target) {
                var src = target[0].src;
                src = src.replace(new URL(src).origin, '');
                var newImage = $('.new-image[value="' + src + '"]');
                var imgCount = $('img[src="' + src + '"]').length;

                if (imgCount === 0) {
                    if (newImage.get().length === 0) {
                        $('<input>', {
                            type: 'hidden',
                            name: 'for_removing[]',
                            value: src
                        }).appendTo('.add-item-form');
                        return;
                    }

                    var editor = $(this);
                    var url = editor.data('image-delete');
                    var data = new FormData();

                    data.append('files', JSON.stringify([src]));

                    loadNewImages(url, data, function (res) {
                        newImage.remove();
                    }, function (error) {
                        console.log(error);
                    });
                }
            }
        }
    });

    $('.add-item-form').on('submit', function () {
        submited = true;
        $('textarea').each(function () {
            $(this).val($(this).val().replace(new RegExp('<p><br></p>', 'g'), ''));
        });
    });

    $(window).on('beforeunload', function () {
        if (! submited) {
            var url = $('.summernote').data('image-delete');
            var data = new FormData();
            var urls = $('.new-image').map(function () {
                return $(this).val();
            }).get();

            data.append('files', JSON.stringify(urls));

            loadNewImages(url, data, function(res) {
                console.log(res)
            }, function (error) {
                console.log(error)
            });
        }
    });
})(jQuery);
