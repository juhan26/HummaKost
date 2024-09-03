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
    <style>
        * {
            scroll-behavior: smooth;
        }
    </style>
    <style>
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
    </style>

</head>

<body>
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
                        <a class="menu-link font-display font-semibold text-base leading-6 text-primary-500 transition duration-500 px-6 py-3"
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

    @if (session('error'))
        <div id="toast-error"
            class="fixed top-8 right-0 mr-1 mt-1 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-lg animate__animated animate__fadeInDown"
            role="alert" aria-live="assertive" aria-atomic="true">
            <div
                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg">
                <span class="material-icons">
                    error
                </span>
            </div>
            <div class="ml-3 text-sm font-medium text-gray-700">
                {{ session('error') }}
            </div>
            <button type="button"
                class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 inline-flex h-8 w-8"
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




    <div class="min-h-screen bg-primary-50/70">
        <!-- Kontainer -->
        <div class="container mx-auto px-4 py-6">
            <!-- Baris -->
            <div class="flex gap-6">
                <!-- Konten Kiri -->
                <div class="flex-1 bg-white p-4 shadow rounded">
                    <div class="container mx-auto p-4">
                        <div class="xl:w-2/5 lg:w-2/5 md:w-2/5 order-1 order-md-0">
                            <!-- User Card -->
                            <div class="mb-6 card">
                                <div class="pt-12 card-body">
                                    <div class="user-avatar-section">
                                        <div class="flex flex-col items-center">
                                            <div class="w-96 h-96 rounded-full bg-center bg-cover"
                                                style="background-image: url('{{ $user->photo ? asset('storage/' . $user->photo) : ($user->gender === 'male' ? asset('assets/img/avatars/5.png') : asset('assets/img/avatars/10.png')) }}');">
                                            </div>

                                            <div class="text-center user-info">
                                                <h5 class="mt-3">{{ $user->name }}</h5>
                                                @foreach ($user->getRoleNames() as $role)
                                                    @if ($role == 'admin')
                                                        <span
                                                            class="px-2 py-1 text-sm font-semibold text-yellow-800 bg-yellow-200 rounded-full">Ketua
                                                            Kontrakan</span>
                                                    @elseif ($role == 'super_admin')
                                                        <span
                                                            class="px-2 py-1 text-sm font-semibold text-blue-800 bg-blue-200 rounded-full">Super
                                                            Admin</span>
                                                    @else
                                                        <span
                                                            class="px-2 py-1 text-sm font-semibold text-red-800 bg-red-200 rounded-full">Penyewa</span>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-wrap justify-around my-6 gap-4">
                                        <div class="flex items-center gap-4 ">
                                            <div
                                                class="flex items-center justify-center w-12 h-12 bg-blue-200 rounded-3">
                                                <style>
                                                    .material-symbols-outlined {
                                                        font-variation-settings:
                                                            'FILL' 0,
                                                            'wght' 400,
                                                            'GRAD' 0,
                                                            'opsz' 24
                                                    }
                                                </style>
                                                <span class="material-icons text-blue-500">
                                                    cottage
                                                </span>
                                            </div>
                                            <div>
                                                <h5
                                                    class="mb-0 px-4 py-2 text-center bg-blue-200 text-blue-500 py-2 rounded-full font-semibold">
                                                    Kontrakan
                                                </h5>
                                                <span>{{ $user->lease ? $user->lease->properties->name : 'Belum Ada Kontrakan' }}</span>
                                            </div>
                                        </div>
                                        @hasrole('admin|tenant')
                                            <div class="flex items-center gap-4">
                                                <div
                                                    class="flex items-center justify-center w-12 h-12 bg-blue-200 rounded-3">
                                                    <style>
                                                        .material-symbols-outlined {
                                                            font-variation-settings:
                                                                'FILL' 0,
                                                                'wght' 400,
                                                                'GRAD' 0,
                                                                'opsz' 24
                                                        }
                                                    </style>
                                                    <span
                                                        class="material-icons .material-symbols-outline text-blue-500 text-3xl">
                                                        school
                                                    </span>

                                                </div>
                                                <div>
                                                    <h5
                                                        class="mb-0 px-4 py-2 text-center bg-blue-200 text-blue-500 py-2 rounded-full font-semibold">
                                                        Sekolah
                                                    </h5>
                                                    <span>{{ $user->instance ? $user->instance->name : 'Sekolah Tidak ditemukan' }}</span>
                                                </div>
                                            </div>
                                        @endhasrole
                                    </div>

                                </div>
                            </div>
                            <!-- /User Card -->
                        </div>

                    </div>
                </div>

                <!-- Konten Kanan -->
                <div class="flex-1 bg-white p-4 shadow rounded" style="height: 100%">
                    <div class="flex flex-col">
                        <!-- Header Tab -->
                        <div class="mb-4">
                            <ul class="flex border-b border-gray-200">
                                <li class="mr-1">
                                    <button
                                        class="px-4 py-2 text-gray-600 hover:text-blue-600 focus:outline-none border-b-2 border-transparent focus:border-blue-600"
                                        id="profile-tab" type="button" onclick="openTab('profile')">
                                        <i class="ri-user-3-line text-lg"
                                            {{ request()->routeIs('#profile-tab') ? 'active' : '' }}></i> Profil
                                    </button>
                                </li>
                                <li class="mr-1">
                                    <button
                                        class="px-4 py-2 text-gray-600 hover:text-blue-600 focus:outline-none border-b-2 border-transparent focus:border-blue-600"
                                        id="security-tab" type="button" onclick="openTab('security')">
                                        <i class="ri-message-2-line text-lg"></i> Keamanan
                                    </button>
                                </li>
                            </ul>
                        </div>

                        {{-- <div id="profile" class="tab-content">
                            <h3 class="font-bold">Profil.</h3>
                        </div>
                        <div id="security" class="tab-content hidden">
                            <h1>Keamanan.</h1>
                        </div> --}}

                        <script>
                            function openTab(tabName) {
                                // Sembunyikan semua tab content
                                const tabs = document.querySelectorAll('.tab-content');
                                tabs.forEach(tab => tab.classList.add('hidden'));

                                // Hapus kelas 'active' dari semua tombol
                                const buttons = document.querySelectorAll('button[id$="-tab"]');
                                buttons.forEach(button => button.classList.remove('active', 'text-blue-600', 'border-blue-600'));

                                // Tampilkan tab yang sesuai dan aktifkan tombolnya
                                document.getElementById(tabName).classList.remove('hidden');
                                document.getElementById(`${tabName}-tab`).classList.add('active', 'text-blue-600', 'border-blue-600');
                            }
                        </script>


                        <!-- Tab Content -->
                        <div id="tab-content">
                            <!-- Profil Tab -->
                            <div class="tab-content active" id="profile-content">
                                <div class="text-lg font-semibold mb-2 font-bold">Detail</div>
                                <ul class="list-none space-y-1">
                                    <li class="flex items-center">
                                        <i class="ri-user-3-line text-2xl"></i>
                                        <span class="ml-2 font-medium me-1">Nama: </span>
                                        <span>{{ $user->name }}</span>
                                    </li>
                                    <li class="flex items-center">
                                        @if ($user->gender == 'male')
                                            <i class="ri-men-line text-2xl"></i>
                                        @else
                                            <i class="ri-women-line text-2xl"></i>
                                        @endif
                                        <span class="ml-2 font-medium me-1">Gender:</span>
                                        <span>{{ $user->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</span>
                                    </li>
                                    <li class="flex items-center">
                                        <i class="ri-check-line text-2xl"></i>
                                        <span class="ml-2 font-medium me-1">Status:</span>
                                        @if ($user->lease)
                                            <span class="bg-green-200 text-green-800 py-1 px-2 rounded-full">
                                                {{ $user->lease->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                            </span>
                                        @else
                                            <span class="bg-red-200 text-red-800 py-1 px-2 rounded-full">Tidak
                                                Aktif</span>
                                        @endif
                                    </li>
                                    <li class="flex items-center">
                                        <i class="ri-star-smile-line text-2xl"></i>
                                        <span class="ml-2 font-medium me-1">Role:</span>
                                        @foreach ($user->getRoleNames() as $role)
                                            <span>
                                                @if ($role == 'admin')
                                                    Ketau Kontrakan
                                                @elseif ($role == 'super_admin')
                                                    Super Admin
                                                @else
                                                    Penyewa
                                                @endif
                                            </span>
                                        @endforeach
                                    </li>
                                </ul>
                                <div class="text-lg font-semibold my-4 font-bold">Kontak</div>
                                <ul class="list-none space-y-1">
                                    <li class="flex items-center">
                                        <i class="ri-phone-line text-2xl"></i>
                                        <span class="ml-2 font-medium me-1">No Hp:</span>
                                        <span>{{ $user->phone_number }}</span>
                                    </li>
                                    <li class="flex items-center">
                                        <i class="ri-mail-open-line text-2xl"></i>
                                        <span class="ml-2 font-medium me-1">Email:</span>
                                        <span>{{ $user->email }}</span>
                                    </li>
                                </ul>

                                <!-- Modal toggle -->


                                <!-- Main modal -->
                                <div id="default-modal" tabindex="-1" aria-hidden="true"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div
                                                class="flex items-center justify-between p-4 md:p-5 rounded-t dark:border-gray-600">
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-hide="default-modal">
                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="text-center mb-6">
                                                <h4 class="mb-2 fs-[30px]">Ubah informasi pengguna</h4>
                                                <p class="mb-6 text-gray-500 dark:text-gray-400">Memperbarui detail
                                                    pengguna akan menerima audit privasi.</p>
                                            </div>
                                            <form action="{{ route('user.update', $user->id) }}" method="post"
                                                enctype="multipart/form-data" id="editUserForm">
                                                @csrf
                                                @method('PUT')
                                                <style>
                                                    .image-container {
                                                        width: 150px;
                                                        /* Atur lebar sesuai kebutuhan */
                                                        height: 150px;
                                                        /* Atur tinggi sesuai kebutuhan */
                                                        background-color: #f3f4f6;
                                                        /* Warna latar belakang kontainer gambar */
                                                        border-radius: 50%;
                                                        /* Membuat kontainer gambar bulat */
                                                        border: 2px solid #e5e7eb;
                                                        /* Border untuk kontainer */
                                                        background-size: cover;
                                                        /* Mengatur gambar latar belakang agar menutupi kontainer */
                                                        background-position: center;
                                                        /* Mengatur posisi gambar agar berada di tengah kontainer */
                                                        position: relative;
                                                        /* Agar overlay dapat diposisikan di atas kontainer */
                                                    }

                                                    .overlay {
                                                        background-color: rgba(0, 0, 0, 0.5);
                                                        /* Latar belakang semi-transparan */
                                                        border-radius: 50%;
                                                        /* Membuat overlay bulat */
                                                        display: flex;
                                                        /* Menyusun ikon edit di tengah */
                                                        align-items: center;
                                                        /* Menyusun ikon edit secara vertikal di tengah */
                                                        justify-content: center;
                                                        /* Menyusun ikon edit secara horizontal di tengah */
                                                        pointer-events: none;
                                                        /* Agar klik tidak mempengaruhi overlay */
                                                    }
                                                </style>
                                                <div
                                                    class="p-4 md:p-5 space-y-4 flex flex-col items-center text-center">
                                                    <!-- Photo upload container -->
                                                    <label for="modalEditUserPhoto" class="relative cursor-pointer">
                                                        <div class="image-container relative" id="imgpp">
                                                            <div
                                                                class="overlay absolute inset-0 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-300">
                                                                <i class="ri-edit-line text-white text-2xl"></i>
                                                            </div>
                                                            <input accept=".jpeg" type="file"
                                                                id="modalEditUserPhoto" name="photo"
                                                                class="absolute inset-0 opacity-0 cursor-pointer"
                                                                onchange="previewImage(event)">
                                                        </div>
                                                    </label>



                                                    <!-- Form fields -->
                                                    <div class="grid gap-4 mb-4 grid-cols-1 md:grid-cols-2 w-full">
                                                        <div class="col-span-2">
                                                            <input type="text" name="name" id="name"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                placeholder="Name" value="{{ $user->name }}">
                                                        </div>
                                                        <div class="col-span-1">
                                                            <select name="gender" id="gender"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                                @if ($user->gender == 'male')
                                                                    <option value="male"
                                                                        {{ $user->gender == 'male' ? 'selected' : '' }}>
                                                                        Laki-Laki</option>
                                                                    <option value="female"
                                                                        {{ $user->gender == 'female' ? 'selected' : '' }}>
                                                                        Perempuan</option>
                                                                @else
                                                                    <option value="female"
                                                                        {{ $user->gender == 'female' ? 'selected' : '' }}>
                                                                        Perempuan</option>
                                                                    <option value="male"
                                                                        {{ $user->gender == 'male' ? 'selected' : '' }}>
                                                                        Laki-Laki</option>
                                                                @endif
                                                            </select>
                                                        </div>

                                                        <div class="col-span-1">
                                                            <input type="number" name="phone_number"
                                                                id="phone_number"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                placeholder="No Hp"
                                                                value="{{ $user->phone_number }}">
                                                        </div>
                                                        <div class="col-span-1">
                                                            <input type="text" name="instance" id="instance"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                placeholder="No Hp"
                                                                value="{{ $user->instance->name }}" disabled>
                                                        </div>
                                                        <div class="col-span-1">
                                                            <input type="text" name="email" id="email"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                placeholder="Name" value="{{ $user->email }}"
                                                                disabled>
                                                        </div>

                                                    </div>
                                                    <button type="submit"
                                                        class="bg-blue-800 hover:bg-blue-700 text-white font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none focus:ring-4 focus:ring-blue-300 transition-colors duration-300 w-25"
                                                        style="background: #20b486">
                                                        Simpan
                                                    </button>
                                            </form>
                                        </div>

                                        <script>
                                            function previewImage(event) {
                                                var reader = new FileReader();
                                                reader.onload = function() {
                                                    var output = document.getElementById('imgpp');
                                                    output.style.backgroundImage = 'url(' + reader.result + ')';
                                                    output.style.backgroundSize = 'cover'; // Ensure the image covers the container
                                                    output.style.backgroundPosition = 'center'; // Center the image
                                                }
                                                reader.readAsDataURL(event.target.files[0]);
                                            }
                                        </script>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <div class="mt-4 flex justify-end">
                                <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                                    class="block text-white bg-red-800 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    type="button" style="background-color: #20b486 ">
                                    Edit
                                </button>
                            </div>
                            <div class="col-12">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                                    <div class="flex flex-col items-start">
                                        <h5 class="text-center text-lg font-weight-light mb-3">Total Yang Sudah Dibayar
                                        </h5>
                                        <div
                                            class="bg-green-100 text-green-800 p-4 rounded-lg shadow-md w-full max-w-md text-center">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <h5 class="text-green-700 text-lg mt-2">
                                                        {{ $user->lease ? 'Rp. ' . number_format($user->lease->total_nominal) : 'Belum Ada Pembayaran' }}
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-start">
                                        <h5 class="text- text-lg font-weight-light mb-3">Total Yang Harus Dibayar</h5>
                                        <div
                                            class="bg-yellow-100 text-yellow-800 p-4 rounded-lg shadow-md w-full max-w-md text-center">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <h5 class="text-yellow-700 text-lg mt-2">
                                                        {{ $user->lease ? ($user->lease->total_nominal === $user->lease->total_iuran ? 'Lunas' : 'Rp. ' . number_format($user->lease->total_iuran - $user->lease->total_nominal)) : 'Belum Ada Tagihan' }}
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-content hidden" id="security-content">
                        <h5 class="text-lg font-semibold mb-4">Ganti Password</h5>
                        <form id="formChangePassword" method="POST" action="{{ route('profile.changePassword') }}"
                            class="space-y-4">
                            @csrf
                            <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg flex items-center">
                                <i class="ri-alert-line text-xl mr-2"></i>
                                <div>
                                    <div class="font-medium">Untuk memastikan bahwa persyaratan ini terpenuhi.
                                    </div>
                                    <div>Minimal 8 karakter untuk password baru.</div>
                                </div>
                                <button type="button" class="ml-auto text-yellow-800 hover:text-yellow-600"
                                    aria-label="Close">
                                    <i class="ri-close-line"></i>
                                </button>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="form-group">
                                    <label for="password" class="block text-sm font-medium text-gray-700">Password
                                        Baru</label>
                                    <input type="password" id="password" name="password" min="8"
                                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                                        placeholder="············">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert" style="color: red">
                                            <p class="text-muted">{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="confirmPassword"
                                        class="block text-sm font-medium text-gray-700">Konfirmasi Password
                                        Baru</label>
                                    <input type="password" id="confirmPassword" name="confirmPassword"
                                        min="8"
                                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                                        placeholder="············">
                                    @error('confirmPassword')
                                        <span class="invalid-feedback" role="alert" style="color: red">
                                            <p class="text-muted">{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex justify-end mt-4">
                                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg"
                                    style="background: #20b486">Ganti
                                    Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('profile-tab').addEventListener('click', function() {
                document.getElementById('profile-content').classList.remove('hidden');
                document.getElementById('security-content').classList.add('hidden');
            });
            document.getElementById('security-tab').addEventListener('click', function() {
                document.getElementById('profile-content').classList.add('hidden');
                document.getElementById('security-content').classList.remove('hidden');
            });
        </script>

    </div>
    </div>
    </div>
    <footer>
        <div class="container px-4 sm:px-6 2xl:px-0">
            <div class="flex flex-wrap justify-between gap-y-6">
                <div class="footer-widget min-w-[320px]">
                    <div class="footer-widget-title xl:mb-6 md:mb-4 mb-3">
                        <a href="#" class="cursor-pointer">
                            <img src="/assets/images/logo.png" alt="New Logo" style="width:90px; height:90px;">
                        </a>
                    </div>
                    <div class="footer-widget-content">
                        <h2 class="text-gray-black text-xl xl:text-2xl tracking-[0.002em] font-semibold lg:mb-4 mb-2">
                            Kontak Kami</h2>
                        <p class="text-base text-gray-500 mb-2">Telepon: <a href="#">+62 823 409 666 94</a></p>
                        <p class="text-base text-gray-500 mb-4 ">Biarkan kami menerima pesan anda.</p>
                        <p class="text-base text-black mb-4">Email: <a href="#">Dcviriya313@mail.com</a></p>
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
                                    class="inline-block text-base text-gray-500 xl:mb-4 md:mb-3 mb-2 footer-link hover:text-primary-500 transition duration-300 ease-in-out">Beranda</a>
                            </li>
                            <li>
                                <a href="#properties"
                                    class="inline-block text-base text-gray-500 xl:mb-4 md:mb-3 mb-2 footer-link hover:text-primary-500 transition duration-300 ease-in-out">Kontrakan</a>
                            </li>
                            <li>
                                <a href="#about"
                                    class="inline-block text-base text-gray-500 xl:mb-4 md:mb-3 mb-2 footer-link hover:text-primary-500 transition duration-300 ease-in-out">Tentang</a>
                            </li>
                            <li>
                                <a href="#feedback"
                                    class="inline-block text-base text-gray-500 xl:mb-4 md:mb-3 mb-2 footer-link hover:text-primary-500 transition duration-300 ease-in-out">Masukan</a>
                            </li>
                        </ul>
                    </div>
                </div>
                {{-- <div class="footer-widget min-w-[160px]">
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
                </div> --}}
                <div class="footer-widget min-w-[320px]">
                    <div class="footer-widget-title xl:mb-8 md:mb-5 mb-3">
                        <h2 class="text-gray-black text-xl xl:text-2xl tracking-[0.002em] font-semibold">Subscribes
                        </h2>Profil
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
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>

</html>
