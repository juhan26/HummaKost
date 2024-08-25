<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Kontrakan Las Vegas" />

    <title>HummaKost</title>

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
            background-image: url('{{ $user->photo ? asset('storage/' . $user->photo) : ($user->gender === 'male' ? asset('assets/img/avatars/1.png') : asset('assets/img/avatars/10.png')) }}');
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
    <header id="header-sticky">
        <div class="bg-white border-b border-gray-50" style="padding: 20px 30px;">
            <div class="container-fluid flex justify-between items-center px-2 sm:px-2 2xl:px-0">
                <!-- Logo -->
                <a href="#">
                    <img src="/assets/images/logo.png" alt="New Logo" style="width:3rem; height:3rem;">
                </a>
                <!-- Menu -->
                <ul class="xl:flex items-center capitalize hidden">
                    <li class="">
                        <a class="menu-link font-display font-semibold text-base leading-6 text-primary-500 transition duration-500 px-6 py-3"
                            href="{{ route('home.index') }}">Beranda</a>
                    </li>
                    <li class="">
                        <a class="menu-link font-display font-semibold text-base leading-6 text-gray-500 hover:text-primary-500 transition duration-500 px-6 py-3"
                            href="{{ route('home.index') }}">Kontrakan</a>
                    </li>
                    <li class="">
                        <a class="menu-link font-display font-semibold text-base leading-6 text-gray-500 hover:text-primary-500 transition duration-500 px-6 py-3"
                            href="{{ route('home.index') }}">Tentang</a>
                    </li>
                    <li class="">
                        <a class="menu-link font-display font-semibold text-base leading-6 text-gray-500 hover:text-primary-500 transition duration-500 px-6 py-3"
                            href="{{ route('home.index') }}">Masukan</a>
                    </li>
                </ul>
                <!-- Right Menu -->
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
                                    <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('assets/img/avatars/1.png') }}"
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

                    <!-- Hamburger Menu -->
                    <div class="xl:hidden inline-block hamburger-btn" id="hamburger-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    @if (session('success'))
        <div id="toast-success"
            class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-lg animate__animated animate__fadeInDown"
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
            class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-lg animate__animated animate__fadeInDown"
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



    <div class="min-h-screen bg-gray-100">
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
                                                <span>{{ $user->properties ? $user->properties->name : 'Sekolah Tidak ditemukan' }}</span>
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
                                        class="px-4 py-2 active text-gray-600 hover:text-blue-600 focus:outline-none border-b-2 border-transparent focus:border-blue-600"
                                        id="profile-tab" type="button">
                                        <i class="ri-user-3-line text-lg"></i> Profil
                                    </button>
                                </li>
                                <li class="mr-1">
                                    <button
                                        class="px-4 py-2 text-gray-600 hover:text-blue-600 focus:outline-none border-b-2 border-transparent focus:border-blue-600"
                                        id="security-tab" type="button">
                                        <i class="ri-message-2-line text-lg"></i> Keamanan
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <!-- Tab Content -->
                        <div id="tab-content">
                            <!-- Profil Tab -->
                            <div class="tab-content active" id="profile-content">
                                <div class="text-lg font-semibold mb-2">Detail</div>
                                <ul class="list-none space-y-4">
                                    <li class="flex items-center">
                                        <i class="ri-user-3-line text-2xl"></i>
                                        <span class="ml-2 font-medium">Nama:</span>
                                        <span>{{ $user->name }}</span>
                                    </li>
                                    <li class="flex items-center">
                                        @if ($user->gender == 'male')
                                            <i class="ri-men-line text-2xl"></i>
                                        @else
                                            <i class="ri-women-line text-2xl"></i>
                                        @endif
                                        <span class="ml-2 font-medium">Gender:</span>
                                        <span>{{ $user->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</span>
                                    </li>
                                    <li class="flex items-center">
                                        <i class="ri-check-line text-2xl"></i>
                                        <span class="ml-2 font-medium">Status:</span>
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
                                        <span class="ml-2 font-medium">Role:</span>
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
                                <div class="text-lg font-semibold mt-4">Kontak</div>
                                <ul class="list-none space-y-4">
                                    <li class="flex items-center">
                                        <i class="ri-phone-line text-2xl"></i>
                                        <span class="ml-2 font-medium">No Hp:</span>
                                        <span>{{ $user->phone_number }}</span>
                                    </li>
                                    <li class="flex items-center">
                                        <i class="ri-mail-open-line text-2xl"></i>
                                        <span class="ml-2 font-medium">Email:</span>
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
                                                        <div class="col-span-1">
                                                            <input type="text" name="name" id="name"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                placeholder="Name"
                                                                value="{{ old('name', $user->name) }}">
                                                        </div>
                                                        <div class="col-span-1">
                                                            <input type="number" name="phone_number"
                                                                id="phone_number"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                placeholder="No Hp"
                                                                value="{{ old('phone_number', $user->phone_number) }}">
                                                        </div>
                                                        <div class="col-span-1">
                                                            <input type="text" name="instance" id="instance"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                placeholder="No Hp"
                                                                value="{{ old('instance', $user->instance->name) }}"
                                                                disabled>
                                                        </div>
                                                        <div class="col-span-1">
                                                            <input type="text" name="email" id="email"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                placeholder="Name"
                                                                value="{{ old('email', $user->email) }}" disabled>
                                                        </div>

                                                    </div>
                                                    <button type="submit"
                                                        class="bg-blue-800 hover:bg-blue-700 text-white font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none focus:ring-4 focus:ring-blue-300 transition-colors duration-300 w-full"
                                                        style="background: rgb(38, 127, 211);">
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
                                    type="button" style="background-color: rgb(13, 82, 255)">
                                    Edit
                                </button>
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
                                </div>
                                <div class="form-group">
                                    <label for="confirmPassword"
                                        class="block text-sm font-medium text-gray-700">Konfirmasi Password
                                        Baru</label>
                                    <input type="password" id="confirmPassword" name="confirmPassword"
                                        min="8"
                                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                                        placeholder="············">
                                </div>
                            </div>
                            <div class="flex justify-end mt-4">
                                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg"
                                    style="background: rgb(49, 89, 249)">Ganti
                                    Password</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-12">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                            <div class="flex flex-col items-center">
                                <h5 class="text-center text-lg font-semibold">Total Yang Sudah Dibayar</h5>
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
                            <div class="flex flex-col items-center">
                                <h5 class="text-center text-lg font-semibold">Total Yang Harus Dibayar</h5>
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
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>

</html>
