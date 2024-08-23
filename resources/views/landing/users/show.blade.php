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
                    <li><a class="menu-link font-display font-semibold text-base leading-6 text-primary-500 transition duration-500 px-6 py-3"
                            href="http://127.0.0.1:8000">Home</a></li>
                    <li><a class="menu-link font-display font-semibold text-base leading-6 text-gray-500 hover:text-primary-500 transition duration-500 px-6 py-3"
                            href="#search_people">Properties</a></li>
                    <li><a class="menu-link font-display font-semibold text-base leading-6 text-gray-500 hover:text-primary-500 transition duration-500 px-6 py-3"
                            href="#loadMember">Tenant</a></li>
                    <li><a class="menu-link font-display font-semibold text-base leading-6 text-gray-500 hover:text-primary-500 transition duration-500 px-6 py-3"
                            href="#descc">About</a></li>
                    <li><a class="menu-link font-display font-semibold text-base leading-6 text-gray-500 hover:text-primary-500 transition duration-500 px-6 py-3"
                            href="#gambars">Feedback</a></li>
                    <li><a class="menu-link font-display font-semibold text-base leading-6 text-gray-500 hover:text-primary-500 transition duration-500 px-6 py-3"
                            href="#blog">Contact</a></li>
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
                            class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-10 hidden">
                            <ul class="py-2 text-gray-700">
                                <li class="flex justify-center items-start gap-3 px-8 py-2 border-b border-gray-200">
                                    <img src="http://127.0.0.1:8000/assets/img/avatars/5.png" alt="User Photo"
                                        class="w-12 h-12 object-cover rounded-full">
                                    <div class="flex flex-col">
                                        <span class="font-semibold">John</span>
                                        <span class="text-gray-500">adzikrasano@gmail.com</span>
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
                                                style="background-image: url('{{ $user->photo ? asset('storage/' . $user->photo) : ($user->gender === 'male' ? asset('assets/img/avatars/1.png') : asset('assets/img/avatars/10.png')) }}');">
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
                                        class="px-4 py-2 text-gray-600 hover:text-blue-600 focus:outline-none border-b-2 border-transparent focus:border-blue-600"
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
                            <div class="tab-content hidden" id="profile-content">
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

                                <div class="mt-4 flex justify-end">
                                    <button class="bg-blue-500 text-white py-2 px-4 rounded-lg" data-bs-toggle="modal"
                                        data-bs-target="#editUser">Edit</button>
                                </div>
                            </div>

                            <!-- Keamanan Tab -->
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
                                            <input type="password" id="password" name="password"
                                                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                                                placeholder="············">
                                        </div>
                                        <div class="form-group">
                                            <label for="confirmPassword"
                                                class="block text-sm font-medium text-gray-700">Konfirmasi Password
                                                Baru</label>
                                            <input type="password" id="confirmPassword" name="confirmPassword"
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
                                    <!-- Total Yang Sudah Dibayar -->
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

                                    <!-- Total Yang Harus Dibayar -->
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



                <!-- Script JavaScript untuk mengontrol tab -->
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





    <!-- Edit Profile Modal -->
    <div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg w-full max-w-md p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Edit Profile</h2>
                <button class="text-gray-600 hover:text-gray-800" onclick="closeEditModal()">&times;</button>
            </div>
            <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Name</label>
                    <input type="text" name="name" id="name" value="{{ $user->name }}"
                        class="w-full mt-1 p-2 border rounded">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ $user->email }}"
                        class="w-full mt-1 p-2 border rounded">
                </div>

                <div class="mb-4">
                    <label for="phone" class="block text-gray-700">Phone</label>
                    <input type="text" name="phone" id="phone" value="{{ $user->phone }}"
                        class="w-full mt-1 p-2 border rounded">
                </div>

                <div class="mb-4">
                    <label for="photo" class="block text-gray-700">Profile Photo</label>
                    <input type="file" name="photo" id="photo" class="w-full mt-1 p-2 border rounded">
                </div>

                <div class="flex justify-end">
                    <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded mr-2 hover:bg-gray-600"
                        onclick="closeEditModal()">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save
                        Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal() {
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        document.getElementById('profile-btn').addEventListener('click', function() {
            document.getElementById('profile-menu').classList.toggle('hidden');
        });

        document.addEventListener('click', function(event) {
            const isClickInsideProfile = document.getElementById('profile-menu').contains(event.target);
            const isClickInsideButton = document.getElementById('profile-btn').contains(event.target);

            if (!isClickInsideProfile && !isClickInsideButton) {
                document.getElementById('profile-menu').classList.add('hidden');
            }
        });
    </script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>

</html>
