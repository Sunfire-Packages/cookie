@if($cookieConsentConfig['enabled'])

    @sunfireCookieScript

    <div id="cookieConsent"></div>

    <script>
        function fetchBanner() {
            fetch('/cookie-consent/view')
                .then(response => response.text())
                .then(html => {
                    document.getElementById('cookieConsent').innerHTML = html
                })
        }

        fetchBanner()
    </script>

@endif
