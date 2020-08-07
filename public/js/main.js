$(window).scroll(function() {
    var height = $(window).scrollTop();
    if(height > 28){
        $('.navbar').addClass('navbar-scroll');
        $('.navbar-toggler').addClass('navbar-toggler-scroll');
        $('.nav-link').addClass('nav-link-scroll');
        $('.navbar-brand').addClass('navbar-brand-scroll');
        $('.nav-item').addClass('nav-item-scroll');
        $('.menu-logo-img').addClass('menu-logo-img-scroll');
    } else{
        $('.navbar').removeClass('navbar-scroll');
        $('.navbar-toggler').removeClass('navbar-toggler-scroll');
        $('.nav-link').removeClass('nav-link-scroll');
        $('.navbar-brand').removeClass('navbar-brand-scroll');
        $('.nav-item').removeClass('nav-item-scroll');
        $('.menu-logo-img').removeClass('menu-logo-img-scroll');
    }
});

$('.js-form-open').on('click', function () {
    $('.form-equipment-block').addClass('form-equipment-block--active');
});

$('.js-form-close').on('click', function () {
    $('.form-equipment-block').removeClass('form-equipment-block--active');
});

$('.js-form-accept').on('change', function () {
    $('.js-button-neu').attr('disabled', ! $(this).is(':checked'));
});
