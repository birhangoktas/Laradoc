<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


    @yield('admin.seo')
    <link rel="shortcut icon" href="http://localhost:8000/favicon.ico" type="image/x-icon">

    <meta property="article:tag" content="Doktorlar">
    <meta property="article:tag" content="Hasta mıyım?">
    <meta property="article:tag" content="Online görüşme">

    <meta property="og:url" content="http://www.localhost.com">
    <meta property="og:site_name" content="localhost.com">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

    <link rel="stylesheet" href="/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/assets/vendors/iconfonts/ionicons/dist/css/ionicons.css">
    <link rel="stylesheet" href="/assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/assets/vendors/css/vendor.bundle.addons.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="/assets/css/shared/style.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/card.css">
    <link rel="stylesheet" href="/css/nice-select.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="/assets/css/demo_1/style.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />



    <style>
    </style>
</head>
<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        @include('admin.nav.top')

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            @include('admin.nav.left')

            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('admin.contect')
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.10.1/js/mdb.min.js">
    </script>
    <!-- bootstrap javascript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <!-- swiper -->

    <script src="https://unpkg.com/swiper/js/swiper.js"></script>
    <!-- swiper -->
    <script src="/js/owl/owl.carousel.min.js"></script>
    <script src="/js/jquery.nice-select.js"></script>
    <script src="/assets/js/demo_1/dashboard.js"></script>


    <script src="/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="/assets/vendors/js/vendor.bundle.addons.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="/assets/js/shared/off-canvas.js"></script>

    <!-- End custom js for this page-->
    <script src="/assets/js/shared/jquery.cookie.js" type="text/javascript"></script>

</body>
</html>
