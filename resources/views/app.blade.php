<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr" data-theme="theme-default"
    data-assets-path="../../assets/" data-template="vertical-menu-template" data-style="light">

<head>
    @include('components.layouts.head')

    <style>
        .toast.show {
            visibility: visible;
            opacity: 1;
            animation: shake 0.5s ease;
        }

        @keyframes shake {
            0% {
                transform: translateX(-10px);
            }

            25% {
                transform: translateX(10px);
            }

            50% {
                transform: translateX(-10px);
            }

            75% {
                transform: translateX(10px);
            }

            100% {
                transform: translateX(0);
            }
        }
    </style>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar bg-white">
        <div class="layout-container">
            {{-- sidebar --}}
            @include('components.layouts.sidebar')
            <!-- Layout container -->
            <div class="layout-page" style="transition: ease-in .3s;">
                <!-- Navbar -->
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y" style="max-width: 100%;position:relative;">
                        @include('components.layouts.navbar')

                        <div class="row g-6">
                            @if (session('success'))
                                <div id="toast-success" class="bs-toast toast toast-ex animate__animated my-2 fade show"
                                    role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="2000">
                                    <div class="toast-header">
                                        <i class="ri-checkbox-circle-fill me-2 text-success"></i>
                                        <div class="me-auto fw-medium">Success</div>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        {{ session('success') }}
                                    </div>
                                </div>
                            @endif
                            @if (session('error'))
                                <div id="toast-error"
                                    class="bs-toast toast toast-ex animate__animated my-2 fade show" role="alert"
                                    aria-live="assertive" aria-atomic="true" data-bs-delay="2000">
                                    <div class="toast-header">
                                        <i class="ri-error-warning-line me-2 text-danger"></i>
                                        <div class="me-auto fw-medium">Error</div>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        {{ session('error') }}
                                    </div>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div id="toast-error"
                                    class="bs-toast toast toast-ex animate__animated my-2 fade show" role="alert"
                                    aria-live="assertive" aria-atomic="true" data-bs-delay="2000">
                                    <div class="toast-header">
                                        <i class="ri-error-warning-line me-2 text-danger"></i>
                                        <div class="me-auto fw-medium">Error</div>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif






                            @yield('content')
                        </div>
                    </div>
                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>
    </div>
    @include('components.layouts.script')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toastDuration = 2300; // 3 seconds

            function hideToast(id) {
                const toast = document.getElementById(id);
                if (toast) {
                    setTimeout(() => {
                        toast.classList.remove('show');
                    }, toastDuration);
                }
            }

            @if (session('success'))
                hideToast('toast-success');
            @endif

            @if (session('error'))
                hideToast('toast-error');
            @endif

            @if ($errors->any())
                @foreach ($errors->all() as $index => $error)
                    setTimeout(() => {
                        document.querySelectorAll('.toast')[{{ $index }}].classList.remove('show');
                    }, toastDuration);
                @endforeach
            @endif
        });
    </script>
</body>

</html>
