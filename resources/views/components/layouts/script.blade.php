<meta charset="utf-8" />
<meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
<title>Dashboard - Analytics | Materialize - Material Design HTML Admin Template</title>
<meta name="description"
    content="Materialize – is the most developer friendly &amp; highly customizable Admin Dashboard Template." />
<meta name="keywords"
    content="dashboard, material, material design, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Canonical SEO -->
<link rel="canonical" href="https://1.envato.market/materialize_admin">
<script>
    (function(w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
            'gtm.start': new Date().getTime(),
            event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s),
            dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
            '../../../../www.googletagmanager.com/gtm5445.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-5J3LMKC');
</script>
<link rel="icon" type="image/x-icon"
    href="https://demos.pixinvent.com/materialize-html-admin-template/assets/img/favicon/favicon.ico" />
<link rel="preconnect" href="https://fonts.googleapis.com/">
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;ampdisplay=swap"
    rel="stylesheet">
<link rel="stylesheet" href="../../assets/vendor/fonts/remixicon/remixicon.css" />
<link rel="stylesheet" href="../../assets/vendor/fonts/flag-icons.css" />
<link rel="stylesheet" href="../../assets/vendor/libs/node-waves/node-waves.css" />
<link rel="stylesheet" href="../../assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
<link rel="stylesheet" href="../../assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
<link rel="stylesheet" href="../../assets/css/demo.css" />
<link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
<link rel="stylesheet" href="../../assets/vendor/libs/typeahead-js/typeahead.css" />
<link rel="stylesheet" href="../../assets/vendor/libs/apex-charts/apex-charts.css" />
<link rel="stylesheet" href="../../assets/vendor/libs/swiper/swiper.css" />

<link rel="stylesheet" href="../../assets/vendor/fonts/materialdesignicons.css" />
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />

<!-- Page CSS -->
<link rel="stylesheet" href="../../assets/vendor/css/pages/cards-statistics.css" />
<link rel="stylesheet" href="../../assets/vendor/css/pages/cards-analytics.css" />
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<!-- Helpers -->
<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
<!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
<script src="../../assets/vendor/js/template-customizer.js"></script>
<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
<script src="../../assets/js/config.js"></script>
{{-- Jquery --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
{{-- SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
