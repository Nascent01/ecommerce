<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="">
    <link rel="icon" type="image/png" href="">
    <title>@yield('title', 'Ecommerce admin')</title>

    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Nucleo Icons -->
    <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="{{ asset('themes/custom/css/style.css') }}" rel="stylesheet" />
    {{-- <link id="pagestyle" href="{{ asset('themes/custom/css/soft-ui-dashboard.css') }}" rel="stylesheet" /> --}}
    @vite(['resources/css/soft-ui-dashboard.css'])

    @livewireStyles

    <!-- Nepcha Analytics -->
    {{-- <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script> --}}
</head>

<body class="g-sidenav-show bg-gray-100">
    @include('admin.partials.left_navigation')

    @include('admin.partials.navbar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        @yield('content')
    </main>

    <!-- Core JS Files -->
    <script src="{{ asset('themes/custom/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('themes/custom/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('themes/custom/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('themes/custom/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('themes/custom/js/plugins/chartjs.min.js') }}"></script>
    <script src="{{ asset('themes/custom/js/plugins/jquery-3.7.1.js') }}"></script>

    @livewireScripts

    @yield('scripts')

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            };
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }

        $(document).ready(function() {
            setupAlerts();

            $(document).on('closeModal', function() {
                setTimeout(function() {
                    setupAlerts();
                }, 100);
            });
        });

        function setupAlerts() {
            $('.alert').each(function() {
                var $alert = $(this);

                if (!$alert.data('timeout-set')) {
                    setTimeout(function() {
                        $alert.slideUp();
                    }, 3000);

                    $alert.data('timeout-set', true);
                }
            });
        }

        window.addEventListener('alertHide', event => {
            setTimeout(function() {
                $(".alert").fadeOut('fast');
            }, 3000);
        });

        window.addEventListener('closeModal', event => {
            $('.modal').modal('hide');
            setTimeout(function() {
                $(".alert").fadeOut('fast');
            }, 3000);
        })
    </script>

    <!-- GitHub buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard -->
    <script src="{{ asset('themes/custom/js/soft-ui-dashboard.min.js') }}"></script>
</body>

</html>
