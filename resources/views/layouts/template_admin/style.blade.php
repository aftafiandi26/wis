<link rel="icon" href="{{ asset('template/administrator/assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />
<script src="{{ asset('template/administrator/assets/js/plugin/webfont/webfont.min.js') }}"></script>
<script>
    WebFont.load({
        google: {
            families: ["Public Sans:300,400,500,600,700"]
        },
        custom: {
            families: [
                "Font Awesome 5 Solid",
                "Font Awesome 5 Regular",
                "Font Awesome 5 Brands",
                "simple-line-icons",
            ],
            urls: ["{{ asset('template/administrator/assets/css/fonts.min.css') }}"],
        },
        active: function() {
            sessionStorage.fonts = true;
        },
    });
</script>
<link rel="stylesheet" href="{{ asset('template/administrator/assets/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('template/administrator/assets/css/plugins.min.css') }}" />
<link rel="stylesheet" href="{{ asset('template/administrator/assets/css/kaiadmin.min.css') }}" />

@stack('style')
