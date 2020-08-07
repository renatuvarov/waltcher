@if( ! env('APP_DEBUG'))
    @push('js')
        <script src="https://www.google.com/recaptcha/api.js?render={{ env('SITE_KEY') }}"></script>
        <script>
            grecaptcha.ready(function () {
                grecaptcha.execute('{{ env('SITE_KEY') }}', {action: 'homepage'}).then(function (token) {
                    document.querySelector('#g-recaptcha-response').value = token;
                });
            });
        </script>
    @endpush
@endif
