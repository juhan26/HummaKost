<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Kontrakan Las Vegas" />

    <title>HummaKost - Kontrakan ideal dengan harga yang terjangkau</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" type="image/x-icon" sizes="128x128" href="/assets/images/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet">
    <link href="/assets/plugins/css/animate.css" rel="stylesheet">
    <link href="/assets/plugins/css/swipper.css" rel="stylesheet">
    <link href="/assets/plugins/css/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/react-icons/4.6.0/react-icons.min.css">
    <link href="/assets/css/tailwind.css" rel="stylesheet">
    <link href="/assets/css/styles.css" rel="stylesheet">
    <link href="/assets/css/responsive.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"  />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <style>
        * {
            scroll-behavior: smooth;
        }
    </style>
    <style>
        #loading-screen {
            position: fixed;
            width: 100%;
            height: 100%;
            background: white;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 1;
            transition: opacity 0.5s ease;
        }

        #loading-screen.hidden {
            opacity: 0;
            pointer-events: none;
        }

        #loading-screen img {
            width: 150px;
            height: auto;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }
    </style>
    {{-- <style>
        /* Container untuk gambar dan ikon */
        .image-container {
            position: relative;
            display: inline-block;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background-position: center;
            background-size: cover;
            background-image: url('{{ $user->photo ? asset('storage/' . $user->photo) : ($user->gender === 'male' ? asset('assets/img/avatars/5.png') : asset('assets/img/avatars/10.png')) }}');
        }

        /* Layer hitam dengan opacity */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.3);
            border-radius: 50%;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        /* Ikon pensil di tengah */
        .overlay i {
            color: white;
            font-size: 24px;
            visibility: hidden;
        }

        /* Efek hover */
        .image-container:hover .overlay {
            opacity: 1;
        }

        .image-container:hover .overlay i {
            visibility: visible;
        }
    </style> --}}

</head>

<body>
    <div id="loading-screen">
        <img src="/assets/images/logo.png" alt="Loading..." />
    </div>
    <script>
        window.addEventListener("load", function() {
            const loadingScreen = document.getElementById("loading-screen");

            // Simulate a delay for the loading screen
            setTimeout(function() {
                loadingScreen.classList.add("hidden"); // Tambahkan kelas hidden untuk fade out
            }, 1000); // Durasi 2 detik sebelum fade out
        });
    </script>

    <!-- header area -->
    <header id="header-sticky">
        <div class=" bg-white border-b border-gray-50 " style="padding: 20px 30px">
            <div class="container-fluid flex justify-between items-center px-2 sm:px-2 2xl:px-0">
                <!-- logo -->
                <div>
                    <a href="#">
                        <img src="/assets/images/logo.png" alt="New Logo" style="width:3rem; height:3rem;">
                    </a>
                </div>
                <!-- logo -->

                <!-- menu -->
                <ul class="xl:flex items-center capitalize hidden">
                    <li class="">
                        <a class="menu-link font-display font-semibold text-base leading-6 text-gray-500 transition duration-500 px-6 py-3"
                            href="{{ route('home.index') }}">Beranda</a>
                    </li>
                    <li class="">
                        <a class="menu-link font-display font-semibold text-base leading-6 text-gray-500 hover:text-primary-500 transition duration-500 px-6 py-3"
                            href="{{ route('home.properties') }}">Kontrakan</a>
                    </li>
                    <li class="">
                        <a class="menu-link font-display font-semibold text-base leading-6 text-gray-500 hover:text-primary-500 transition duration-500 px-6 py-3"
                            href="#tentang">Tentang</a>
                    </li>
                    <li class="">
                        <a class="menu-link font-display font-semibold text-base leading-6 text-gray-500 hover:text-primary-500 transition duration-500 px-6 py-3"
                            href="#masukan">Masukan</a>
                    </li>
                    {{-- @auth
                        @hasrole('admin|tenant')
                            <li class="">
                                <a class="menu-link font-display font-semibold text-base leading-6 text-primary-500 hover:text-primary-500 transition duration-500 px-6 py-3"
                                    href="{{ route('user.history', Auth::user()->id) }}">History</a>
                            </li>
                        @endhasrole
                    @endauth --}}
                </ul>
                <!-- menu end -->

                <!-- right menu -->
                <div class="flex items-center">
                    <div
                        class="flex items-center gap-2 text-base font-display font-medium text-gray-500 hover:text-primary-500 transition duration-500">
                        <span class="flex justify-center items-center"></span>

                        @php
                            $user = Auth::user();
                            $hasNonMemberRole = $user && $user->roles()->where('name', '!=', 'tenant')->exists();
                        @endphp
                        @if ($hasNonMemberRole)
                            <div class="relative">
                                <button id="profile-btn" onclick="a(this)"
                                    class="flex items-center justify-center w-90 h-10 bg-white text-gray-600 hover:bg-white focus:outline-none">
                                    <img src="@if (Auth::user()->photo) {{ asset('storage/' . Auth::user()->photo) }} @elseif(Auth::user()->gender === 'male') {{ asset('assets/img/avatars/1.png') }}@else {{ asset('assets/img/avatars/10.png') }} @endif"
                                        onclick="a(this)" alt="User Photo" class="object-cover w-10 h-10 rounded-full">
                                    {{-- <strong style="margin-left: 0.5rem" class="hover:text-primary-500 transform-gpu"
                                        onclick="a(this)">{{ Auth::user()->name }}</strong> --}}
                                </button>
                                <div id="profile-menu"
                                    class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg hidden z-10">
                                    <ul class="py-2 text-gray-700">
                                        {{-- <li class="flex items-center gap-2 px-4 py-2">
                                        <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('assets/img/avatars/1.png') }}"
                                            onclick="a(this)" alt="User Photo"
                                            class="w-7 h-7 object-cover rounded-full">
                                        <strong class="block px-4 py-2">{{ Auth::user()->name }}</strong>
                                    </li> --}}
                                        <li>
                                            <a href="{{ route('dashboard') }}"
                                                class="items-center block px-4 py-2 text-sm hover:bg-gray-100"><span>{{ 'Dasbor' }}</span></a>
                                        </li>
                                        <li>
                                            <a href="{{ route('logout') }}"
                                                class="block px-4 py-2 text-sm hover:bg-gray-100"
                                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                Keluar
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @elseif($user && $user->roles->contains('name', 'tenant') && $user->status === 'accepted')
                            <div class="relative">
                                <button id="profile-btn" onclick="a(this)"
                                    class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-200 text-gray-600 hover:bg-gray-300 focus:outline-none">
                                    <img src="
                                    @if (Auth::user()->photo) {{ asset('storage/' . Auth::user()->photo) }}
                                    @elseif(Auth::user()->gender === 'male')
                                    {{ asset('assets/img/avatars/5.png') }}
                                    @elseif(Auth::user()->gender === 'female')
                                        {{ asset('assets/img/avatars/10.png') }} @endif"
                                        onclick="a(this)" alt="User Photo"
                                        class="w-full h-full object-cover rounded-full">
                                </button>
                                <div id="profile-menu"
                                    class="absolute right-0 mt-2 max-w-xs bg-white border border-gray-200 rounded-lg shadow-lg hidden z-10">
                                    <ul class="py-2 text-gray-700">
                                        <li
                                            class="flex justify-center items-start gap-3 px-8 py-2 border-b border-gray-200 overflow-hidden">
                                            <img src="@if (Auth::user()->photo) {{ asset('storage/' . Auth::user()->photo) }}
                                                    @elseif(Auth::user()->gender === 'male')
                                                        {{ asset('assets/img/avatars/5.png') }}
                                                    @elseif(Auth::user()->gender === 'female')
                                                        {{ asset('assets/img/avatars/10.png') }} @endif"
                                                alt="User Photo" class="w-12 h-12 object-cover rounded-full">
                                            <div class="flex flex-col" style="object-fit: cover">
                                                <span class="font-semibold">{{ Auth::user()->name }}</span>
                                                <p class="text-gray-500 text-smd" text-muted>
                                                    {{ Auth::user()->email }}</small>
                                            </div>
                                        </li>
                                        <li>

                                            <a href="{{ route('user.profile', Auth::user()->id) }}"
                                                class="items-center block px-4 py-2 text-sm hover:bg-gray-100"><span>{{ 'Profile' }}</span></a>
                                        </li>

                                        <li>
                                            <a href="{{ route('user.history', Auth::user()->id) }}"
                                                class="block px-4 py-2 text-sm hover:bg-gray-100">
                                                History
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('logout') }}"
                                                class="block px-4 py-2 text-sm hover:bg-gray-100"
                                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                Keluar
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @else
                                <a href="{{ route('register') }}"
                                    class="hidden xl:inline-block border hover:bg-primary-500 hover:text-white transition duration-500 text-primary-500"
                                    style="padding:12px 16px; border-radius:8px; margin-right: 1rem"><span>{{ 'Daftar' }}</span></a>
                                <a href="{{ route('login') }}"
                                    class="hidden xl:inline-block btn-primary"><span>{{ 'Masuk' }}</span></a>
                        @endif
                    </div>

                    <!-- Hamburger Menu -->
                    <div class="xl:hidden inline-block hamburger-btn" id="hamburger-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>

                <script>
                    document.getElementById('profile-btn').addEventListener('click', function(event) {
                        event.preventDefault(); // Prevent default action to avoid reloading
                        var menu = document.getElementById('profile-menu');
                        menu.classList.toggle('hidden');
                    });

                    // window.addEventListener('click', function(event) {
                    //     var menu = document.getElementById('profile-menu');
                    //     var button = document.getElementById('profile-btn');
                    //     if (!menu.contains(event.target) && event.target !== button) {
                    //         menu.classList.add('hidden');
                    //     }
                    // });

                    function a() {
                        var menu = document.getElementById('profile-menu');
                        // var button = document.getElementById('profile-btn');
                        if (!menu.contains(event.target) && event.target !== button) {
                            menu.classList.add('hidden');
                        }
                    }
                </script>

                <!-- right menu end -->
            </div>
        </div>
    </header>
    @if (session('success'))
        <div id="toast-success"
            class="fixed top-8 right-0 mr-1 mt-1 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-lg animate__animated animate__fadeInDown"
            role="alert" aria-live="assertive" aria-atomic="true">
            <div
                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
                <span class="material-icons">
                    check_circle
                </span>
            </div>
            <div class="ml-3 text-sm font-medium text-gray-700">
                {{ session('success') }}
            </div>
            <button type="button"
                class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5  inline-flex h-8 w-8"
                aria-label="Close" onclick="this.parentElement.style.display='none';">
                <span class="sr-only">Close</span>
                <span class="material-icons">
                    close
                </span>
            </button>
        </div>
    @endif


    @if ($errors->any())
        <div id="toast-error"
            class="fixed top-8 right-0 mr-1 mt-1 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-lg animate__animated animate__fadeInDown"
            role="alert" aria-live="assertive" aria-atomic="true">
            <div
                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg">
                <span class="material-icons">
                    error
                </span>
            </div>
            @foreach ($errors->all() as $error)
                <div class="ml-3 text-sm font-medium text-gray-700">
                    {{ $error }}
                </div>
            @endforeach
            <button type="button"
                class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 hover:text-gray-900 inline-flex h-8 w-8"
                aria-label="Close" onclick="this.parentElement.style.display='none';">
                <span class="sr-only">Close</span>
                <span class="material-icons">
                    close
                </span>
            </button>
        </div>
    @endif


    <section
        class="mx-auto 2xl:w-3/4 pl-5 bg-primary-50/70 rounded-2xl shadow-md flex items-center justify-between mx-5 mt-5">
        <div class="flex-1">
            <h1 class="text-3xl font-bold text-gray-800">Riwayat Pembayaran</h1>
            <p class="text-gray-600 mt-2">Kontrakan | Riwayat Pembayaran Bulanan</p>
        </div>
        <div class="flex-shrink-0">
            <img src="/assets/images/banner_atas.png" alt="Logo" class="w-80 h-30">
        </div>
    </section>
    <div class="space-y-8 py-8 mx-4 w-3/4" style="margin-left: 14rem; margin-right: 14rem;">


        @forelse ($leases as $lease)
            @php
                foreach ($lease->payments as $payment) {
                    $due_date = $payment->due_date;
                }
                $startReminderDate = \Carbon\Carbon::parse($due_date)->subDays(3);
                $endReminderDate = \Carbon\Carbon::parse($due_date);
                $daysLeft = today()->diffInDays(\Carbon\Carbon::parse($due_date));
            @endphp
            @if (today()->between($startReminderDate, $endReminderDate))
                <div class="w-full" style=" border-radius: 30px">
                    @if ($daysLeft > 0)
                        <div class="bg-red-200 text-center p-4 shadow-md" style="border-radius: 30px">
                            <span class="text-gray-700">Tenggat Waktu Pembayaran</span>
                            <h5 class="text-red-600 mt-2 text-xl">
                                {{ $daysLeft }} Hari
                            </h5>
                        </div>
                        {{-- <p><strong style="color: red">Reminder{{ $daysLeft }} Hari
                        </strong>
                    </p> --}}
                    @elseif ($daysLeft == 0)
                        <div class="bg-red-200 text-center p-4 shadow-md" style="border-radius: 30px">
                            <h5 class="text-red-600 mt-2 text-xl">
                                Hari ini Tenggat Pembayaranmu !!
                            </h5>
                        </div>
                    @endif
                </div>
            @endif


            <div class="flex justify-center gap-4">
                <!-- Total Yang Sudah Dibayar -->
                <div class="w-full" style=" border-radius: 30px">
                    <div class="bg-green-200 text-center p-4 shadow-md" style="border-radius: 30px">
                        <span class="text-gray-700">Total Yang Sudah Dibayar</span>
                        <h5 class="text-green-600 mt-2 text-xl">
                            {{ 'Rp. ' . number_format($lease->total_nominal) }}
                        </h5>
                    </div>
                </div>
                <!-- Total Iuran -->
                <div class="w-full" style=" border-radius: 30px">
                    <div class="bg-red-200 text-center p-4 rounded-lg shadow-md" style="border-radius: 30px">
                        <span class="text-gray-700">Total Iuran</span>
                        <h5 class="text-red-600 mt-2 text-xl">
                            {{ 'Rp. ' . number_format($lease->total_iuran) }}
                        </h5>
                    </div>
                </div>
                <!-- Sisa Nominal Yang Harus Dibayar -->
                <div class="w-full" style=" border-radius: 30px">
                    <div class="bg-yellow-200 text-center p-4 rounded-lg shadow-md" style="border-radius: 30px">
                        <span class="text-yellow-600">Sisa Nominal Yang Harus Dibayar</span>
                        <h5 class="text-yellow-600 mt-2 text-xl">
                            {{ $lease->total_nominal === $lease->total_iuran ? 'Lunas' : 'Rp. ' . number_format($lease->total_iuran - $lease->total_nominal) }}
                        </h5>
                    </div>
                </div>
            </div>

            <!-- Data Pembayaran -->
            <div class=" p-8 rounded-lg max-w-8xl mx-auto" style="height: 45rem">
                <div class="2xl:w-12 mx-auto">
                    <!-- Search Bar -->
                </div>


                <!-- Tabel Pembayaran -->

                <div class="relative overflow-x-auto shadow-lg sm:rounded-lg">
                    <table class="w-full text-lg text-left rtl:text-right text-gray-600 dark:text-gray-300">
                        <thead
                            class="text-md text-gray-800 uppercase bg-green-100 dark:bg-gray-700 dark:text-gray-300">
                            <tr>
                                <th scope="col" class="px-8 py-4">
                                    Nama
                                </th>
                                <th scope="col" class="px-8 py-4">
                                    Nominal
                                </th>
                                <th scope="col" class="px-8 py-4">
                                    Pembayaran Untuk Bulan
                                </th>
                                <th scope="col" class="px-8 py-4">
                                    Tanggal Pembayaran
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($lease->payments as $index => $payment)
                                <tr
                                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-8 py-4 font-semibold text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $lease->user->name }}
                                    </th>
                                    <td class="px-8 py-4">
                                        {{ 'Rp. ' . number_format($payment->nominal) }}
                                    </td>
                                    <td class="px-8 py-4">
                                        {{ \Carbon\Carbon::parse($payment->month)->locale('id')->translatedFormat('j F Y') }}
                                    </td>
                                    <td class="px-8 py-4">
                                        {{ \Carbon\Carbon::parse($payment->created_at)->locale('id')->translatedFormat('j F Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-8 py-4 text-center text-gray-500">Belum ada
                                        pembayaran.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
    </div>

@empty
    <div class="space-y-8 py-8 mx-4 mb:mx-16 w-3/4" style="margin-left: 14rem; margin-right: 14rem; height: 45rem;">
        <<div class="flex justify-center gap-4">
            <!-- Total Yang Sudah Dibayar -->
            <div class="w-full" style=" border-radius: 30px">
                <div class="bg-green-200 text-center p-4 shadow-md" style="border-radius: 30px">
                    <span class="text-gray-700">Total Yang Sudah Dibayar</span>
                    <h5 class="text-green-600 mt-2 text-xl">
                        Rp. 0
                    </h5>
                </div>
            </div>
            <!-- Total Iuran -->
            <div class="w-full" style=" border-radius: 30px">
                <div class="bg-red-200 text-center p-4 rounded-lg shadow-md" style="border-radius: 30px">
                    <span class="text-gray-700">Total Iuran</span>
                    <h5 class="text-red-600 mt-2 text-xl">
                        Rp. 0
                    </h5>
                </div>
            </div>
            <!-- Sisa Nominal Yang Harus Dibayar -->
            <div class="w-full" style=" border-radius: 30px">
                <div class="bg-yellow-200 text-center p-4 rounded-lg shadow-md" style="border-radius: 30px">
                    <span class="text-yellow-600">Sisa Nominal Yang Harus Dibayar</span>
                    <h5 class="text-yellow-600 mt-2 text-xl">
                        Rp. 0
                    </h5>
                </div>
            </div>
    </div>
    <div class="text-center d-flex flex-col text-gray-500" style="margin-top: 4rem">
        <i class="ri-money-dollar-circle-line text-primary-500" style="font-size: 3rem"></i>
        <h1 class="text-primary-500">Tidak ada data kontrak yang tersedia.</h1>
    </div>
    </div>
    @endforelse
    </div>

    <!-- footer area start -->
    <footer>
        <div class="container px-4 sm:px-6 2xl:px-0">
            <div class="flex flex-wrap justify-between gap-y-6">
                <div class="footer-widget min-w-[320px]">
                    <div class="footer-widget-title xl:mb-6 md:mb-4 mb-3">
                        <a href="#" class="cursor-pointer">
                            <img src="/assets/img/images/logo.png" alt="New Logo" style="width:300px; height:90px;">
                        </a>
                    </div>
                    <div class="footer-widget-content">
                        <h2 class="text-gray-black text-xl xl:text-2xl tracking-[0.002em] font-semibold lg:mb-4 mb-2">
                            Contact Us</h2>
                        <p class="text-base text-gray-500 mb-2">Call : <a href="#">+123 400 123</a></p>
                        <p class="text-base text-gray-500 mb-4 ">Praesent nulla massa, hendrerit vestibulum gravida
                            in, feugiat auctor felis.</p>
                        <p class="text-base text-black mb-4">Email: <a href="#">example@mail.com</a></p>
                        <ul class="flex gap-4">
                            <li>
                                <a href=""
                                    class="bg-primary-50 p-3.5 rounded-lg inline-flex justify-center items-center hover:bg-primary-500 text-primary-500 hover:text-white hover:-translate-y-1 transform transition-all duration-500">
                                    <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14.9851 0.166504H11.5888C9.57338 0.166504 7.33162 1.03077 7.33162 4.00943C7.34145 5.04731 7.33162 6.0413 7.33162 7.15996H5V10.9429H7.40377V21.8332H11.8208V10.871H14.7362L15 7.14935H11.7447C11.7447 7.14935 11.752 5.4938 11.7447 5.01302C11.7447 3.83592 12.946 3.90333 13.0183 3.90333C13.5899 3.90333 14.7014 3.90503 14.9868 3.90333V0.166504H14.9851Z"
                                            fill="currentColor" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href=""
                                    class="bg-primary-50 p-3.5 rounded-lg inline-flex justify-center items-center hover:bg-primary-500 text-primary-500 hover:text-white hover:-translate-y-1 transform transition-all duration-500">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_231_413)">
                                            <path
                                                d="M0 10C0 8.18666 0.44668 6.51334 1.34 4.98C2.23334 3.44666 3.44668 2.23334 4.98 1.34C6.51334 0.44666 8.18668 0 10 0C11.8133 0 13.4867 0.44666 15.02 1.34C16.5533 2.23334 17.7667 3.44666 18.66 4.98C19.5533 6.51334 20 8.18666 20 10C20 11.8133 19.5533 13.4867 18.66 15.02C17.7667 16.5533 16.5533 17.7667 15.02 18.66C13.4867 19.5533 11.8133 20 10 20C8.18668 20 6.51334 19.5533 4.98 18.66C3.44668 17.7667 2.23334 16.5533 1.34 15.02C0.44668 13.4867 0 11.8133 0 10ZM1.66 10C1.66 12.08 2.36 13.9133 3.76 15.5C4.4 14.2467 5.41334 13.0533 6.8 11.92C8.18668 10.7867 9.54 10.0733 10.86 9.78C10.66 9.31334 10.4667 8.89334 10.28 8.52C7.98668 9.25334 5.50668 9.62 2.84 9.62C2.32 9.62 1.93334 9.61334 1.68 9.6C1.68 9.65334 1.67668 9.72 1.67 9.8C1.66334 9.88 1.66 9.94666 1.66 10ZM1.92 7.94C2.21334 7.96666 2.64668 7.98 3.22 7.98C5.44668 7.98 7.56 7.68 9.56 7.08C8.54668 5.28 7.43334 3.78 6.22 2.58C5.16668 3.11334 4.26334 3.85334 3.51 4.8C2.75668 5.74666 2.22668 6.79334 1.92 7.94ZM4.9 16.58C6.40668 17.7533 8.10668 18.34 10 18.34C10.9867 18.34 11.9667 18.1533 12.94 17.78C12.6733 15.5 12.1533 13.2933 11.38 11.16C10.1533 11.4267 8.91668 12.1 7.67 13.18C6.42334 14.26 5.5 15.3933 4.9 16.58ZM7.96 1.94C9.13334 3.15334 10.22 4.66666 11.22 6.48C13.0333 5.72 14.4 4.75334 15.32 3.58C13.7733 2.3 12 1.66 10 1.66C9.32 1.66 8.64 1.75334 7.96 1.94ZM11.94 7.9C12.14 8.32666 12.3667 8.86666 12.62 9.52C13.6067 9.42666 14.68 9.38 15.84 9.38C16.6667 9.38 17.4867 9.4 18.3 9.44C18.1933 7.62666 17.54 6.01334 16.34 4.6C15.4733 5.89334 14.0067 6.99334 11.94 7.9ZM13.12 10.92C13.8 12.8933 14.26 14.92 14.5 17C15.5533 16.32 16.4133 15.4467 17.08 14.38C17.7467 13.3133 18.1467 12.16 18.28 10.92C17.3067 10.8533 16.42 10.82 15.62 10.82C14.8867 10.82 14.0533 10.8533 13.12 10.92Z"
                                                fill="currentColor" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_231_413">
                                                <rect width="20" height="20" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href=""
                                    class="bg-primary-50 p-3.5 rounded-lg inline-flex justify-center items-center hover:bg-primary-500 text-primary-500 hover:text-white hover:-translate-y-1 transform transition-all duration-500">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_231_417)">
                                            <path
                                                d="M0 2.32323C0 1.64982 0.225232 1.09426 0.675676 0.656565C1.12612 0.218848 1.71172 0 2.43243 0C3.14029 0 3.71299 0.215474 4.15058 0.646464C4.60102 1.09091 4.82625 1.67002 4.82625 2.38383C4.82625 3.0303 4.60747 3.569 4.16988 3.99999C3.71944 4.44444 3.12741 4.66666 2.39382 4.66666H2.37452C1.66666 4.66666 1.09396 4.44444 0.656371 3.99999C0.218784 3.55555 0 2.99662 0 2.32323ZM0.250965 20V6.50504H4.53668V20H0.250965ZM6.9112 20H11.1969V12.4646C11.1969 11.9932 11.2484 11.6296 11.3514 11.3737C11.5315 10.9158 11.805 10.5286 12.1718 10.2121C12.5386 9.8956 12.9987 9.73736 13.5521 9.73736C14.9936 9.73736 15.7143 10.7542 15.7143 12.7879V20H20V12.2626C20 10.2693 19.5496 8.75756 18.6486 7.72726C17.7477 6.69696 16.5573 6.18181 15.0772 6.18181C13.417 6.18181 12.1236 6.92928 11.1969 8.42423V8.46463H11.1776L11.1969 8.42423V6.50504H6.9112C6.93693 6.93601 6.94981 8.27607 6.94981 10.5252C6.94981 12.7744 6.93693 15.9326 6.9112 20Z"
                                                fill="currentColor" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_231_417">
                                                <rect width="20" height="20" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href=""
                                    class="bg-primary-50 p-3.5 rounded-lg inline-flex justify-center items-center hover:bg-primary-500 text-primary-500 hover:text-white hover:-translate-y-1 transform transition-all duration-500">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_231_423)">
                                            <path
                                                d="M6.66721 10C6.66721 8.15913 8.15913 6.6664 10 6.6664C11.8409 6.6664 13.3336 8.15913 13.3336 10C13.3336 11.8409 11.8409 13.3336 10 13.3336C8.15913 13.3336 6.66721 11.8409 6.66721 10ZM4.86511 10C4.86511 12.836 7.16397 15.1349 10 15.1349C12.836 15.1349 15.1349 12.836 15.1349 10C15.1349 7.16397 12.836 4.8651 10 4.8651C7.16397 4.8651 4.86511 7.16397 4.86511 10ZM14.1381 4.66155C14.1381 5.32391 14.6753 5.86187 15.3385 5.86187C16.0008 5.86187 16.5388 5.32391 16.5388 4.66155C16.5388 3.99919 16.0016 3.46204 15.3385 3.46204C14.6753 3.46204 14.1381 3.99919 14.1381 4.66155ZM5.95961 18.1397C4.98465 18.0953 4.45477 17.933 4.10259 17.7956C3.6357 17.6139 3.30291 17.3974 2.95234 17.0477C2.60259 16.6979 2.3853 16.3651 2.20436 15.8982C2.06704 15.546 1.90469 15.0162 1.86026 14.0412C1.81179 12.9871 1.8021 12.6704 1.8021 10C1.8021 7.32956 1.8126 7.01373 1.86026 5.9588C1.90469 4.98384 2.06785 4.45477 2.20436 4.10178C2.38611 3.63489 2.60259 3.3021 2.95234 2.95153C3.3021 2.60178 3.6349 2.38449 4.10259 2.20355C4.45477 2.06624 4.98465 1.90388 5.95961 1.85945C7.01373 1.81099 7.33037 1.80129 10 1.80129C12.6704 1.80129 12.9863 1.81179 14.0412 1.85945C15.0162 1.90388 15.5452 2.06704 15.8982 2.20355C16.3651 2.38449 16.6979 2.60178 17.0485 2.95153C17.3982 3.30129 17.6147 3.63489 17.7964 4.10178C17.9338 4.45396 18.0961 4.98384 18.1406 5.9588C18.189 7.01373 18.1987 7.32956 18.1987 10C18.1987 12.6696 18.189 12.9863 18.1406 14.0412C18.0961 15.0162 17.933 15.546 17.7964 15.8982C17.6147 16.3651 17.3982 16.6979 17.0485 17.0477C16.6987 17.3974 16.3651 17.6139 15.8982 17.7956C15.546 17.933 15.0162 18.0953 14.0412 18.1397C12.9871 18.1882 12.6704 18.1979 10 18.1979C7.33037 18.1979 7.01373 18.1882 5.95961 18.1397ZM5.87722 0.0605816C4.8126 0.109047 4.08562 0.277868 3.44992 0.52504C2.79241 0.780291 2.23506 1.12278 1.67851 1.67851C1.12278 2.23425 0.780291 2.7916 0.52504 3.44992C0.277868 4.08562 0.109047 4.8126 0.0605816 5.87722C0.0113086 6.94346 0 7.28433 0 10C0 12.7157 0.0113086 13.0565 0.0605816 14.1228C0.109047 15.1874 0.277868 15.9144 0.52504 16.5501C0.780291 17.2076 1.12197 17.7658 1.67851 18.3215C2.23425 18.8772 2.7916 19.2189 3.44992 19.475C4.08643 19.7221 4.8126 19.891 5.87722 19.9394C6.94427 19.9879 7.28433 20 10 20C12.7165 20 13.0565 19.9887 14.1228 19.9394C15.1874 19.891 15.9144 19.7221 16.5501 19.475C17.2076 19.2189 17.7649 18.8772 18.3215 18.3215C18.8772 17.7658 19.2189 17.2076 19.475 16.5501C19.7221 15.9144 19.8918 15.1874 19.9394 14.1228C19.9879 13.0557 19.9992 12.7157 19.9992 10C19.9992 7.28433 19.9879 6.94346 19.9394 5.87722C19.891 4.8126 19.7221 4.08562 19.475 3.44992C19.2189 2.79241 18.8772 2.23506 18.3215 1.67851C17.7658 1.12278 17.2076 0.780291 16.5509 0.52504C15.9144 0.277868 15.1874 0.108239 14.1236 0.0605816C13.0574 0.0121163 12.7165 0 10.0008 0C7.28433 0 6.94427 0.0113086 5.87722 0.0605816Z"
                                                fill="currentColor" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_231_423">
                                                <rect width="20" height="20" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href=""
                                    class="bg-primary-50 p-3.5 rounded-lg inline-flex justify-center items-center hover:bg-primary-500 text-primary-500 hover:text-white hover:-translate-y-1 transform transition-all duration-500">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.07031 8.92189C8.07031 8.92189 9.96264 8.78323 9.96264 6.59293C9.96264 4.40248 8.41448 3.3335 6.4534 3.3335H0.000244141V15.5741H6.4534C6.4534 15.5741 10.3928 15.6969 10.3928 11.9612C10.3928 11.9612 10.5646 8.92189 8.07031 8.92189ZM5.9889 5.50912H6.4534C6.4534 5.50912 7.33057 5.50912 7.33057 6.78269C7.33057 8.05612 6.8147 8.24074 6.22956 8.24074H2.84359V5.50912H5.9889ZM6.27104 13.3985H2.84359V10.1274H6.4534C6.4534 10.1274 7.76078 10.1105 7.76078 11.8084C7.76078 13.2401 6.78429 13.3877 6.27104 13.3985ZM15.6467 6.44786C10.8776 6.44786 10.8818 11.151 10.8818 11.151C10.8818 11.151 10.5546 15.8301 15.6467 15.8301C15.6467 15.8301 19.8901 16.0694 19.8901 12.5751H17.7078C17.7078 12.5751 17.7805 13.891 15.7195 13.891C15.7195 13.891 13.5368 14.0354 13.5368 11.7614H19.9628C19.9628 11.7614 20.666 6.44786 15.6467 6.44786ZM13.5129 10.1274C13.5129 10.1274 13.7793 8.2407 15.6952 8.2407C17.6106 8.2407 17.5866 10.1274 17.5866 10.1274H13.5129ZM18.095 5.56196H12.9786V4.05462H18.095V5.56196Z"
                                            fill="currentColor" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="footer-widget min-w-[160px]">
                    <div class="footer-widget-title xl:mb-8 md:mb-5 mb-3">
                        <h2 class="text-gray-black text-xl xl:text-2xl tracking-[0.002em] font-semibold">Explore</h2>
                    </div>
                    <div class="footer-widget-content">
                        <ul>
                            <li class="">
                                <a href="#"
                                    class="inline-block text-base text-gray-500 xl:mb-4 md:mb-3 mb-2 footer-link hover:text-primary-500 transition duration-300 ease-in-out">Home</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="inline-block text-base text-gray-500 xl:mb-4 md:mb-3 mb-2 footer-link hover:text-primary-500 transition duration-300 ease-in-out">About</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="inline-block text-base text-gray-500 xl:mb-4 md:mb-3 mb-2 footer-link hover:text-primary-500 transition duration-300 ease-in-out">Course</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="inline-block text-base text-gray-500 xl:mb-4 md:mb-3 mb-2 footer-link hover:text-primary-500 transition duration-300 ease-in-out">Blog</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="inline-block text-base text-gray-500 xl:mb-4 md:mb-3 mb-2 footer-link hover:text-primary-500 transition duration-300 ease-in-out">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="footer-widget min-w-[160px]">
                    <div class="footer-widget-title xl:mb-8 md:mb-5 mb-3">
                        <h2 class="text-gray-black text-xl xl:text-2xl tracking-[0.002em] font-semibold">Category</h2>
                    </div>
                    <div class="footer-widget-content">
                        <ul>
                            <li>
                                <a href="#"
                                    class="inline-block text-base text-gray-500 xl:mb-4 md:mb-3 mb-2 footer-link hover:text-primary-500 transition duration-300 ease-in-out">Design</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="inline-block text-base text-gray-500 xl:mb-4 md:mb-3 mb-2 footer-link hover:text-primary-500 transition duration-300 ease-in-out">Development</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="inline-block text-base text-gray-500 xl:mb-4 md:mb-3 mb-2 footer-link hover:text-primary-500 transition duration-300 ease-in-out">Marketing</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="inline-block text-base text-gray-500 xl:mb-4 md:mb-3 mb-2 footer-link hover:text-primary-500 transition duration-300 ease-in-out">Business</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="inline-block text-base text-gray-500 xl:mb-4 md:mb-3 mb-2 footer-link hover:text-primary-500 transition duration-300 ease-in-out">Lifestyle</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="inline-block text-base text-gray-500 xl:mb-4 md:mb-3 mb-2 footer-link hover:text-primary-500 transition duration-300 ease-in-out">Photography</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="inline-block text-base text-gray-500 xl:mb-4 md:mb-3 mb-2 footer-link hover:text-primary-500 transition duration-300 ease-in-out">Music</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="footer-widget min-w-[320px]">
                    <div class="footer-widget-title xl:mb-8 md:mb-5 mb-3">
                        <h2 class="text-gray-black text-xl xl:text-2xl tracking-[0.002em] font-semibold">Subscribes
                        </h2>
                    </div>
                    <div class="footer-widget-content">
                        <p class="text-base text-gray-500 mb-8 max-w-[297px]">Lorem Ipsum has been them an industry
                            printer took a galley make book.</p>
                        <form>
                            <input type="email" placeholder="Email here"
                                class="p-4 bg-gray-custom/50 rounded-lg w-full block mb-6 focus:outline-none focus:ring-1 focus:ring-primary-500 transition duration-300 ease-in-out">
                            <!-- /focus:outline-none focus:ring-1 focus:ring-primary-500 transition duration-300 ease-in-out -->
                            <button type="button" class="btn-primary">
                                <span>Subscribes Now</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer area end -->


    <script>
        // Scroll to #tenant section if the URL contains #tenant fragment
        document.addEventListener('DOMContentLoaded', function() {
            if (window.location.hash === '#tenant') {
                document.getElementById('tenant').scrollIntoView();
            }
        });
    </script>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="/assets/plugins/js/jquery.js"></script>
    <script src="/assets/plugins/js/swipper.js"></script>
    <script src="/assets/plugins/js/waypoint.js"></script>
    <script src="/assets/plugins/js/counter.js"></script>
    <script src="/assets/plugins/js/aos.js"></script>
    <script src="/assets/js/main2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
</body>



</html>
