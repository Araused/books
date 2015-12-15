$(document).ready(function () {
    $('.book-img').on({
        click: function () {
            if ($(this).hasClass('book-img-big')) {
                $(this).removeClass('book-img-big');
            } else {
                $(this).addClass('book-img-big');
            }
        }
    });

    $('.view-book').on({
        click: function () {
            var url = $(this).attr('href');
            $.ajax({
                url: url,
                type: 'GET',
                success: function (data) {
                    $('#book-info').html(data);
                }
            });
        }
    });
});