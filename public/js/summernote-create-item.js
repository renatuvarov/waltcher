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
            ['insert', ['link','picture', 'video']],
            ['misc', ['codeview']],
        ],
        callbacks: {
            onImageUpload: function (files) {
                var editor = $(this);
                var url = editor.data('image-url');
                var data = new FormData();
                data.append('file', files[0]);

                loadNewImages(url, data,
                    function (res) {
                        editor.summernote('insertImage', res);

                        $('<input>', {
                            type: 'hidden',
                            name: 'images[]',
                            value: res,
                            class: 'new-image'
                        }).appendTo('.add-item-form');
                    },
                    function (error) {
                        console.log(error);
                    }
                );
            },
            onMediaDelete: function(target) {
                var src = target[0].src;
                src = src.replace(new URL(src).origin, '');

                if ($('img[src="' + src + '"]').length === 0) {
                    var editor = $(this);
                    var url = editor.data('image-delete');
                    var data = new FormData();

                    data.append('files', JSON.stringify([src]));

                    loadNewImages(url, data, function (res) {
                        $('input[value="' + src + '"]').remove();
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
            var urls = $('.new-image').map(function () {
                return $(this).val();
            }).get();

            var url = $('.summernote').data('image-delete');
            var data = new FormData();
            data.append('files', JSON.stringify(urls));
            $('.new-image').remove();

            loadNewImages(url, data, function(res) {
                console.log(res)
            }, function (error) {
                console.log(error)
            });
        }
    });
})($);
