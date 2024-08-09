<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr" data-theme="theme-default"
    data-assets-path="../../assets/" data-template="vertical-menu-template" data-style="light">

<head>
    @include('components.layouts.head')

</head>

<body>
    <div class="layout-wrapper layout-content-navbar  ">
        <div class="layout-container">
            {{-- sidebar --}}
            @include('components.layouts.sidebar')
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('components.layouts.navbar')
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row g-6">
                            @if (session('success'))
                                <div class="col-12">
                                    <div class="alert alert-solid-success alert-dismissible d-flex align-items-center shadow-sm"
                                        role="alert">
                                        <span class="alert-icon rounded">
                                            <i class="ri-checkbox-circle-line ri-22px"></i>
                                        </span>
                                        <strong> {{ session('success') }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close" aria-hidden="true"></button>
                                    </div>
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="col-12">
                                    <div class="alert alert-solid-danger alert-dismissible d-flex align-items-center shadow-sm"
                                        role="alert">
                                        <span class="alert-icon rounded">
                                            <i class="ri-checkbox-circle-line ri-22px"></i>
                                        </span>
                                        <strong> {{ session('error') }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close" aria-hidden="true"></button>
                                    </div>
                                </div>
                            @endif
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="col-12">
                                        <div class="alert alert-solid-danger alert-dismissible d-flex align-items-center shadow-sm"
                                            role="alert">
                                            <span class="alert-icon rounded">
                                                <i class="ri-checkbox-circle-line ri-22px"></i>
                                            </span>
                                            <strong> {{ $error }}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close" aria-hidden="true"></button>
                                        </div>
                                    </div>
                                @endforeach
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
</body>

</html>
    