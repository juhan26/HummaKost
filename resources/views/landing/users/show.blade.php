<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Kontrakan Las Vegas" />

    <title>HummaKost</title>
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
                    <!-- Profile Menu -->
                    <div class="relative">
                        <button id="profile-btn"
                            class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-200 text-gray-600 hover:bg-gray-300 focus:outline-none">
                            <img src="http://127.0.0.1:8000/assets/img/avatars/5.png" alt="User Photo"
                                class="w-full h-full object-cover rounded-full">
                        </button>
                        <div id="profile-menu"
                            class="absolute right-0 mt-2 bg-white border border-gray-200 rounded-lg shadow-lg z-10 hidden">
                            <ul class="py-2 text-gray-700">
                                <li class="flex justify-center items-start gap-3 px-8 py-2 border-b border-gray-200">
                                    <img src="http://127.0.0.1:8000/assets/img/avatars/5.png" alt="User Photo"
                                        class="w-12 h-12 object-cover rounded-full">
                                    <div class="flex flex-col">
                                        <span class="font-semibold">{{ Auth::user()->name }}</span>
                                        <span class="text-gray-500">{{ Auth::user()->email }}</span>
                                    </div>
                                </li>
                                <li>
                                    <a href="http://127.0.0.1:8000/logout"
                                        class="block px-4 py-2 text-sm hover:bg-gray-100"
                                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="http://127.0.0.1:8000/logout" method="POST"
                                        class="hidden">
                                        <input type="hidden" name="_token"
                                            value="Gxf5IR410fiQ9jhYNYH3xLqleHTs5jBgttdNxmEI">
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>

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
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="ml-3 text-sm font-medium text-gray-700">
                {{ session('success') }}
            </div>
            <button type="button"
                class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 hover:text-gray-900 inline-flex h-8 w-8"
                aria-label="Close" onclick="this.parentElement.style.display='none';">
                <span class="sr-only">Close</span>
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M4.293 9.293a1 1 0 011.414 0L9 12.586l4.293-4.293a1 1 0 111.414 1.414l-5 5a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    @endif


    @if ($errors->any())
        <div id="toast-error"
            class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-lg animate__animated animate__fadeInDown"
            role="alert" aria-live="assertive" aria-atomic="true">
            <div
                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm-3.707-5.707a1 1 0 011.414 0L9 12.586l1.293-1.293a1 1 0 111.414 1.414l-2 2a1 1 0 01-1.414 0l-2-2a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
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
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M4.293 9.293a1 1 0 011.414 0L9 12.586l4.293-4.293a1 1 0 111.414 1.414l-5 5a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
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
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="flex items-center justify-center w-12 h-12 bg-blue-200 rounded-3">
                                                <span class="material-symbols-outlined">cottage</span>
                                            </div>
                                            <div>
                                                <h5 class="mb-0">Kontrakan</h5>
                                                <span>{{ $user->lease ? $user->lease->properties->name : 'belum ada' }}</span>
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
                                                    <span class="material-symbols-outlined">
                                                        school
                                                    </span>
                                                </div>
                                                <div>
                                                    <h5 class="mb-0">Sekolah</h5>
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
                                <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                                    class="block text-black bg-red-800 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    type="button" style="background-color: blue">
                                    Edit
                                </button>

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
                                            <div class="p-4 md:p-5 space-y-4">
                                                <label for="modalEditUserPhoto">
                                                    <div class="image-container " id="imgpp">
                                                        <div class="overlay">
                                                            <i class="ri-edit-line"></i>
                                                        </div>
                                                        <input accept=".jpeg" type="file" id="modalEditUserPhoto"
                                                            name="photo" class="form-control" hidden
                                                            onchange="previewImage(event)">
                                                    </div>
                                                </label>

                                                <script>
                                                    function previewImage(event) {
                                                        var reader = new FileReader();
                                                        reader.onload = function() {
                                                            var output = document.getElementById('imgpp');
                                                            output.style.backgroundImage = 'url(' + reader.result + ')';
                                                        }
                                                        reader.readAsDataURL(event.target.files[0]);
                                                    }
                                                </script>
                                                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                    The European Union’s General Data Protection Regulation (G.D.P.R.)
                                                    goes into effect on May 25 and is meant to ensure a common set of
                                                    data rights in the European Union. It requires organizations to
                                                    notify users as soon as possible of high-risk data breaches that
                                                    could personally affect them.
                                                </p>
                                            </div>
                                            <!-- Modal footer -->
                                            <div
                                                class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                <button data-modal-hide="default-modal" type="button"
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I
                                                    accept</button>
                                                <button data-modal-hide="default-modal" type="button"
                                                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 flex justify-end">
                                    <button class="bg-blue-500 text-white py-2 px-4 rounded-lg" data-bs-toggle="modal"
                                        data-bs-target="#editUser">Edit</button>
                                </div>
                                <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true"
                                    style="display: none;">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="text-center mb-6">
                                                    <h4 class="mb-2">Edit User Information</h4>
                                                    <p class="mb-6">Updating user details will receive a privacy
                                                        audit.</p>
                                                </div>
                                                <!-- Menampilkan Foto Pengguna -->
                                                <form action="{{ route('user.update', $user->id) }}" method="post"
                                                    enctype="multipart/form-data" id="editUserForm"
                                                    class="row g-5 fv-plugins-bootstrap5 fv-plugins-framework justify-content-center">
                                                    @csrf
                                                    @method('PUT')


                                                    <div class="col-12 col-md-6 d-flex flex-column align-items-center">
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

                                                        <label for="modalEditUserPhoto">
                                                            <div class="image-container" id="imgpp">
                                                                <div class="overlay">
                                                                    <i class="ri-edit-line"></i>
                                                                </div>
                                                                <input accept=".jpeg" type="file"
                                                                    id="modalEditUserPhoto" name="photo"
                                                                    class="form-control" hidden
                                                                    onchange="previewImage(event)">
                                                            </div>
                                                        </label>

                                                        <script>
                                                            function previewImage(event) {
                                                                var reader = new FileReader();
                                                                reader.onload = function() {
                                                                    var output = document.getElementById('imgpp');
                                                                    output.style.backgroundImage = 'url(' + reader.result + ')';
                                                                }
                                                                reader.readAsDataURL(event.target.files[0]);
                                                            }
                                                        </script>


                                                    </div>
                                                    <div class="col-12 fv-plugins-icon-container">
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="text" id="name" name="name"
                                                                class="form-control"
                                                                value="{{ old('name', $user->name) }}"
                                                                placeholder="{{ old('name', $user->name) }}">
                                                            <label for="name">Name</label>
                                                        </div>
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-12">

                                                        <div class="input-group input-group-merge">
                                                            <div class="form-floating form-floating-outline">
                                                                <input type="text" id="phone_number"
                                                                    name="phone_number"
                                                                    class="form-control phone-number-mask"
                                                                    value="{{ old('phone_number', $user->phone_number) }}"
                                                                    placeholder="{{ old('phone_number', $user->phone_number) }}">
                                                                <label for="phone_number">Phone Number</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @hasrole('admin|user')
                                                        <div class="col-6">
                                                            <div class="form-floating form-floating-outline">
                                                                <input type="text" id="school_id" name="school_id"
                                                                    class="form-control"
                                                                    placeholder="{{ $user->instance->name }}"
                                                                    value="{{ $user->instance->name }}" disabled>
                                                                <label for="school_id">Sekolah</label>
                                                            </div>
                                                        </div>
                                                    @endhasrole
                                                    <div class="col-12">
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="text" id="email" name="email"
                                                                class="form-control" value="{{ $user->email }}"
                                                                placeholder="{{ $user->email }}" disabled>
                                                            <label for="email">Email</label>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-12 text-center d-flex flex-wrap justify-content-center gap-4 row-gap-4">
                                                        <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light">Submit</button>
                                                        <button type="reset"
                                                            class="btn btn-outline-secondary waves-effect"
                                                            data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                                    </div>
                                                    <input type="hidden">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content hidden" id="security-content">
                                <h5 class="text-lg font-semibold mb-4">Ganti Password</h5>
                                <form id="formChangePassword" method="POST"
                                    action="{{ route('profile.changePassword') }}" class="space-y-4">
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
                                            <label for="password"
                                                class="block text-sm font-medium text-gray-700">Password Baru</label>
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
                                        <button type="submit"
                                            class="bg-blue-500 text-white py-2 px-4 rounded-lg">Ganti Password</button>
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
