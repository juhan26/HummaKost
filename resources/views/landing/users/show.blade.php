<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="Kontrakan Las Vegas" />

    <title>HummaKost</title>
    <link rel="icon" type="image/x-icon" sizes="128x128 " href="/assets/images/logo.png" style="">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- favicon -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.7.0/vanilla-tilt.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <!-- css link -->
    <link href="/assets/plugins/css/animate.css" rel="stylesheet">
    <link href="/assets/plugins/css/swipper.css" rel="stylesheet">
    <link href="/assets/plugins/css/aos.css" rel="stylesheet">
    <link href="/assets/css/tailwind.css" rel="stylesheet">
    <link href="/assets/css/styles.css" rel="stylesheet">
    <link href="/assets/css/responsive.css" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script> --}}
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        * {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body>
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
                            href="http://127.0.0.1:8000">home</a>
                    </li>
                    <li class="">
                        <a class="menu-link font-display font-semibold text-base leading-6 text-gray-500 hover:text-primary-500 transition duration-500 px-6 py-3"
                            href="#search_people">properties</a>
                    </li>
                    <li class="">
                        <a class="menu-link font-display font-semibold text-base leading-6 text-gray-500 hover:text-primary-500 transition duration-500 px-6 py-3"
                            href="#loadMember">tenant</a>
                    </li>
                    <li class="">
                        <a class="menu-link font-display font-semibold text-base leading-6 text-gray-500 hover:text-primary-500 transition duration-500 px-6 py-3"
                            href="#descc">about</a>
                    </li>
                    <li class="">
                        <a class="menu-link font-display font-semibold text-base leading-6 text-gray-500 hover:text-primary-500 transition duration-500 px-6 py-3"
                            href="#gambars">feedback</a>
                    </li>
                    <li class="">
                        <a class="menu-link font-display font-semibold text-base leading-6 text-gray-500 hover:text-primary-500 transition duration-500 px-6 py-3"
                            href="#blog">contact</a>
                    </li>
                </ul>
                <!-- menu end -->

                <!-- right menu -->
                <div class="flex items-center">
                    <div
                        class="flex items-center gap-2 text-base font-display font-medium text-gray-500 hover:text-primary-500 transition duration-500">
                        <span class="flex justify-center items-center"></span>

                        <div class="relative">
                            <button id="profile-btn" onclick="a(this)"
                                class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-200 text-gray-600 hover:bg-gray-300 focus:outline-none">
                                <img src="
                                                                        http://127.0.0.1:8000/assets/img/avatars/5.png
                                    "
                                    onclick="a(this)" alt="User Photo" class="w-full h-full object-cover rounded-full">
                            </button>
                            <div id="profile-menu"
                                class="absolute right-0 mt-2 max-w-xs bg-white border border-gray-200 rounded-lg shadow-lg z-10 hidden">
                                <ul class="py-2 text-gray-700">
                                    <li
                                        class="flex justify-center items-start gap-3 px-8 py-2 border-b border-gray-200 overflow-hidden">
                                        <img src="                                                        http://127.0.0.1:8000/assets/img/avatars/5.png
                                                    "
                                            alt="User Photo" class="w-12 h-12 object-cover rounded-full">
                                        <div class="flex flex-col" style="object-fit: cover">
                                            <span class="font-semibold">John</span>
                                            <span class="text-gray-500" text-muted="">adzikrasano@gmail.com
                                            </span>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="http://127.0.0.1:8000/users/show/6"
                                            class="block px-4 py-2 text-sm hover:bg-gray-100">Profile</a>
                                    </li>
                                    <li>
                                        <a href="http://127.0.0.1:8000/logout"
                                            class="block px-4 py-2 text-sm hover:bg-gray-100"
                                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="http://127.0.0.1:8000/logout" method="POST"
                                            class="d-none">
                                            <input type="hidden" name="_token"
                                                value="Gxf5IR410fiQ9jhYNYH3xLqleHTs5jBgttdNxmEI" autocomplete="off">
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
        </div>
    </header>
    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold text-gray-700">Profile</h1>
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                    onclick="openEditModal()">Edit Profile</button>
            </div>

            <div class="flex items-center gap-6 mb-6">
                <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('assets/img/image_not_available.png') }}"  class="w-24 h-24 object-cover rounded-full" alt="{{ $user->name }}">
                <div>
                    <h2 class="text-xl font-semibold">{{ $user->name }}</h2>
                    <p class="text-gray-600">{{ $user->email }}</p>
                    <p class="text-gray-600">Instance: {{ $user->instance->name }}</p>
                </div>
            </div>

            <!-- User Details -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Personal Information</h3>
                <div class="mt-2">
                    <p class="text-gray-600"><strong>Phone:</strong> {{ $user->phone_number }}</p>
                    <p class="text-gray-600"><strong>Joined:</strong>
                        {{ $user->created_at->format('d M Y') }}</p>
                </div>
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
                    <label for="address" class="block text-gray-700">Address</label>
                    <textarea name="address" id="address" rows="3" class="w-full mt-1 p-2 border rounded">{{ $user->address }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="instance" class="block text-gray-700">Instance</label>
                    <select name="instance_id" id="instance" class="w-full mt-1 p-2 border rounded">
                        @foreach ($instances as $instance)
                            <option value="{{ $instance->id }}"
                                {{ $user->instance_id == $instance->id ? 'selected' : '' }}>
                                {{ $instance->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="avatar" class="block text-gray-700">Avatar</label>
                    <input type="file" name="avatar" id="avatar" class="w-full mt-1 p-2 border rounded">
                </div>

                <div class="flex justify-end">
                    <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded mr-2"
                        onclick="closeEditModal()">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save
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
    </script>
</body>

</html>
