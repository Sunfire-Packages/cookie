<div x-data="cookieConsent()" x-init="init()">
    <div x-ref="banner"></div>
</div>

<script>

    function cookieConsent() {
        return {
            open: false,
            data: null,
            async init() {
                const response = await fetch('/cookie-consent/blade')
                const content = await response.text()
                let banner = this.$refs.banner;

                if (banner) {
                    banner.innerHTML = content
                }

                this.open=  true

            }
        }
    }

</script>