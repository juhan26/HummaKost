<!DOCTYPE html>
<html lang="en" class="light-style layout-wide  customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="../../assets/" data-template="vertical-menu-template" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Multi Steps Sign-up - Pages | Materialize - Material Design HTML Admin Template</title>
    <meta name="description"
        content="Materialize – is the most developer friendly &amp; highly customizable Admin Dashboard Template." />
    <meta name="keywords"
        content="dashboard, material, material design, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
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

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="../../assets/vendor/libs/node-waves/node-waves.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/typeahead-js/typeahead.css" />
    <!-- Vendor -->
    <link rel="stylesheet" href="../../assets/vendor/libs/bs-stepper/bs-stepper.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/bootstrap-select/bootstrap-select.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/%40form-validation/form-validation.css" />

    <!-- Page CSS -->

    <!-- Page -->
    <link rel="stylesheet" href="../../assets/vendor/css/pages/page-auth.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" href="sweetalert2.min.css">
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="../../assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../assets/js/config.js"></script>

</head>

<body>
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: "Pendaftaran Berhasil",
                    text: @json(session('success')),
                    showConfirmButton:false,
                    footer: '<a href="/login" class="btn btn-primary">Tutup</a>'
                });
            });
        </script>
    @endif
    <!-- ?PROD Only: Google Tag Manager (noscript) (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5J3LMKC" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!-- Content -->
    <div class="authentication-wrapper authentication-cover">
        <!-- Logo -->
        <a href="/" class="auth-cover-brand d-flex align-items-center gap-2"
        data-aos="fade-right" data-aos-duration="1000" >
            <span class="app-brand-text demo text-heading fw-semibold">HummaKost</span>
        </a>
        <!-- /Logo -->
        <div class="authentication-inner row m-0">

            <!-- Left Text -->
            <div class="d-none d-lg-flex col-lg-4 align-items-center justify-content-center p-12 mt-12 mt-xxl-0"
                data-aos="fade-in" data-aos-duration="1500" data-aos-delay="500">
                <img alt="register-multi-steps-illustration" src="{{ asset('assets/images/Sign up-pana.png') }}"
                    class="h-auto mh-100 w-100">
            </div>
            <!-- /Left Text -->

            <!--  Multi Steps Registration -->
            <div class="d-flex col-lg-8 align-items-center justify-content-center authentication-bg p-5" style="position: relative">
                <a href="/" style="position: absolute;top:20px;left:20px;"><i style="font-size: 40px;" class="mdi ri-arrow-left-s-line"></i></a>
                <div class="w-px-700 mt-12 mt-lg-0 pt-lg-0 pt-4">
                    <div id="multiStepsValidation" class="bs-stepper wizard-numbered shadow-none">
                        <div class="bs-stepper-header border-bottom-0 mb-2">
                            <div class="step" data-target="#accountDetailsValidation">
                                <button type="button" class="step-trigger ps-0">
                                    <span class="bs-stepper-circle" ><i class="ri-check-line"></i></span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-number">01</span>
                                        <span class="d-flex flex-column ms-2">
                                            <span class="bs-stepper-title">Akun</span>
                                            <span class="bs-stepper-subtitle">Detail Akun</span>
                                        </span>
                                    </span>
                                </button>
                            </div>
                            <div class="line" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="700"></div>
                            <div class="step" data-target="#personalInfoValidation">
                                <button type="button" class="step-trigger" >
                                    <span class="bs-stepper-circle" ><i class="ri-check-line"></i></span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-number">02</span>
                                        <span class="d-flex flex-column ms-2">
                                            <span class="bs-stepper-title">Pribadi</span>
                                            <span class="bs-stepper-subtitle">Masukkan Informasi</span>
                                        </span>
                                    </span>
                                </button>
                            </div>
                        </div>
                        <div class="bs-stepper-content">
                            <form action="{{ route('register') }}" id="multiStepsForm" method="post">
                                @method('POST')
                                @csrf
                                <!-- Account Details -->
                                <div id="accountDetailsValidation" class="content">
                                    <div class="content-header mb-5">
                                        <h4 class="mb-1" >Informasi Akun</h4>
                                        <span >Masukkan Detail Akunmu</span>
                                    </div>
                                    <div class="row gx-5">
                                        <div class="col-sm-6 col-lg-12 col-md-12 mb-5">
                                            <div class="form-floating form-floating-outline">
                                                <input type="email" name="email" id="multiStepsEmail"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    placeholder="contoh@gmail.com" aria-label="john.doe"
                                                    value="{{ old('email') }}" />
                                                <label for="multiStepsEmail" >Email</label>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert" >
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 form-password-toggle mb-5">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="password" id="multiStepsPass" name="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                        aria-describedby="multiStepsPass2"/>
                                                    <label for="multiStepsPass">Password</label>
                                                </div>
                                                <span class="input-group-text cursor-pointer" id="multiStepsPass2"><i
                                                        class="ri-eye-off-line"></i></span>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 form-password-toggle mb-5">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="password" id="multiStepsConfirmPass"
                                                        name="password_confirmation" class="form-control"
                                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                        aria-describedby="multiStepsConfirmPass2"/>
                                                    <label for="multiStepsConfirmPass" >Konfirmasi Password</label>
                                                </div>
                                                <span class="input-group-text cursor-pointer"
                                                    id="multiStepsConfirmPass2" ><i class="ri-eye-off-line" ></i></span>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-between">
                                            <button type="button" class="btn btn-outline-secondary btn-prev"
                                                disabled > <i class="ri-arrow-left-line ri-16px me-sm-1_5 me-0"></i>
                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                            </button>
                                            <button type="button" class="btn btn-secondary btn-next"> <span
                                                    class="align-middle d-sm-inline-block d-none me-sm-1_5 me-0">Next</span>
                                                <i class="ri-arrow-right-line ri-16px"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Personal Info -->
                                <div id="personalInfoValidation" class="content">
                                    <div class="content-header mb-5">
                                        <h4 class="mb-1">Informasi Pribadi</h4>
                                        <span>Masukkan Informasi Pribadi Anda</span>
                                    </div>
                                    <div class="row gx-5">
                                        <div class="col-sm-6 col-lg-12 col-md-12 mb-5">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" id="multiStepsFirstName" name="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    placeholder="John" value="{{ old('name') }}" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="1100"/>
                                                <label for="multiStepsFirstName" >Nama Lengkap</label>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-5">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="number" id="multiStepsMobile" name="phone_number"
                                                        class="form-control @error('phone_number') is-invalid @enderror"
                                                        placeholder="202 555 0111"
                                                        value="{{ old('phone_number') }}" />
                                                    <label for="multiStepsMobile">Nomor Telepon</label>
                                                    @error('phone_number')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6  mb-5">
                                            <div class="form-floating form-floating-outline">
                                                <select id="gender" class="select2 form-select"
                                                    data-allow-clear="true" name="gender">
                                                    <option value="male">Laki-laki</option>
                                                    <option value="female">Perempuan</option>
                                                </select>
                                                <label for="multiStepsState">Jenis Kelamin</label>
                                                @error('gender')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-12 col-md-12 mb-5">
                                            <div class="form-floating form-floating-outline">
                                                <select id="multiStepsState" class="select2 form-select"
                                                    data-allow-clear="true" name="instance_id">
                                                    @php
                                                         $instances = \App\Models\Instance::orderBy('name','ASC')->get();
                                                    @endphp
                                                    @foreach ($instances as $instance)
                                                    <option value="{{ $instance->id }}">{{ $instance->name }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="multiStepsState">Instansi</label>
                                                @error('instance')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-between">
                                            <button type="button" class="btn btn-outline-secondary btn-prev"> <i
                                                    class="ri-arrow-left-line ri-16px me-sm-1_5 me-0"></i>
                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                            </button>
                                            <button type="submit" class="btn btn-primary btn-next btn-submit">Submit
                                                <i class="ri-check-line ri-16px ms-1_5"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / Multi Steps Registration -->
        </div>
    </div>


    <!-- Core JS -->
    <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../../assets/vendor/libs/hammer/hammer.js"></script>
    <script src="../../assets/vendor/libs/i18n/i18n.js"></script>
    <script src="../../assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="../../assets/vendor/js/menu.js"></script>
    <script src="../../assets/vendor/libs/cleavejs/cleave.js"></script>
    <script src="../../assets/vendor/libs/cleavejs/cleave-phone.js"></script>
    <script src="../../assets/vendor/libs/bs-stepper/bs-stepper.js"></script>
    <script src="../../assets/vendor/libs/select2/select2.js"></script>
    <script src="../../assets/vendor/libs/%40form-validation/popular.js"></script>
    <script src="../../assets/vendor/libs/%40form-validation/bootstrap5.js"></script>
    <script src="../../assets/vendor/libs/%40form-validation/auto-focus.js"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../assets/js/main.js"></script>
    <script src="../../assets/js/pages-auth-multisteps.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>
{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
