<div class="cookies-notification js-cookies-notification">
    <p class="cookie-text">
        This website uses cookies. A cookie is a small text file that the website you are visiting stores on your computer. Cookies are used by a lot of websites to give visitors access to various functions. It is possible to use the information in the cookie to follow the user’s surfing. To avoid cookies, you can change the security settings in your web browser. How these are adjusted depends on which web browser you have. On this website we use cookies to enable you as a visitor to adapt the appearance of the website. The majority are the so called “session cookies”. They will be automatically deleted after the visit on the website. Cookies do not cause any harm to your computer and do not contain viruses.
    </p>
    <button type="button" class="button-neu js-cookie-ok">Ok</button>
</div>

@push('js')
    <script>
        if (! localStorage.getItem('cookie-notification')) {
            $('.cookies-notification').addClass('cookies-notification-active');
        }

        $('.js-cookie-ok').on('click', function () {
            $('.js-cookies-notification').removeClass('cookies-notification-active');
            localStorage.setItem('cookie-notification', 1);
        });
    </script>
@endpush
