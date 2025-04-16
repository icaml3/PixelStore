$(document).ready(function() {
    $('.catagory-menu a').on('click', function(e) {
        e.preventDefault();

        $('.catagory-menu a').removeClass('active');
        $(this).addClass('active');

        var filterValue = $(this).attr('data-filter');

        $('.no-products-message').hide();

        var visibleItems = 0;

        $('.oneMusic-albums .single-album-item').each(function() {
            if (filterValue === '*') {
                $(this).fadeIn('fast');
                visibleItems++;
            } else {
                if ($(this).hasClass(filterValue.replace('.', ''))) {
                    $(this).fadeIn('fast');
                    visibleItems++;
                } else {
                    $(this).fadeOut('fast');
                }
            }
        });

        if (visibleItems === 0) {
            $('.no-products-message').fadeIn('fast');
        }
    });
});
