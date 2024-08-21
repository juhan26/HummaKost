<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Kontrakan Las Vegas" />
    <title>HummaKost</title>
    <link rel="icon" type="image/x-icon" sizes="128x128" href="/assets/images/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <link href="/assets/plugins/css/animate.css" rel="stylesheet">
    <link href="/assets/plugins/css/swipper.css" rel="stylesheet">
    <link href="/assets/plugins/css/aos.css" rel="stylesheet">
    <link href="/assets/css/tailwind.css" rel="stylesheet">
    <link href="/assets/css/styles.css" rel="stylesheet">
    <link href="/assets/css/responsive.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        * {
            scroll-behavior: smooth;
        }

        /* Menambahkan padding dan margin yang konsisten */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Public Sans', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        header {
            padding: 20px 30px;
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
        }

        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo img {
            width: 3rem;
            height: 3rem;
        }

        .menu-link {
            padding: 8px 12px;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .menu-link:hover {
            color: #0d6efd;
        }

        .profile-btn img {
            width: 2.5rem;
            height: 2.5rem;
        }

        .profile-menu {
            width: 240px;
        }

        .profile-menu li {
            padding: 10px;
        }

        .profile-menu li:hover {
            background-color: #f1f1f1;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 15px;
            background-color: #ffffff;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .profile-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .profile-header h1 {
            font-size: 1.75rem;
            font-weight: 700;
        }

        .profile-header button {
            background-color: #0d6efd;
            color: #ffffff;
            padding: 8px 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .profile-header button:hover {
            background-color: #0a58ca;
        }

        .profile-details img {
            width: 6rem;
            height: 6rem;
            border-radius: 50%;
        }

        .profile-details div {
            margin-left: 20px;
        }

        .profile-info h2 {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .profile-info p {
            font-size: 1rem;
            color: #555;
        }

        .edit-modal {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .edit-modal-content {
            max-width: 500px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
        }

        .edit-modal-content h2 {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .edit-modal-content button {
            background-color: #e2e8f0;
            color: #333;
        }

        .edit-modal-content button:hover {
            background-color: #cbd5e1;
        }
    </style>
</head>

<body>
    <header>
        <div class="header-container">
            <!-- Logo -->
            <div class="logo">
                <a href="#">
                    <img src="/assets/images/logo.png" alt="New Logo">
                </a>
            </div>

            <!-- Menu -->
            <ul class="xl:flex items-center capitalize hidden">
                <li><a class="menu-link" href="http://127.0.0.1:8000">Home</a></li>
                <li><a class="menu-link" href="#search_people">Properties</a></li>
                <li><a class="menu-link" href="#loadMember">Tenant</a></li>
                <li><a class="menu-link" href="#descc">About</a></li>
                <li><a class="menu-link" href="#gambars">Feedback</a></li>
                <li><a class="menu-link" href="#blog">Contact</a></li>
            </ul>

            <!-- Profile -->
            <div class="flex items-center gap-2">
                <button id="profile-btn" class="profile-btn">
                    <img src="http://127.0.0.1:8000/assets/img/avatars/5.png" alt="User Photo" class="rounded-full">
                </button>
                <div id="profile-menu" class="profile-menu absolute right-0 mt-2 bg-white border hidden z-10">
                    <ul class="py-2">
                        <li class="flex items-center gap-3 px-8 py-2 border-b">
                            <img src="http://127.0.0.1:8000/assets/img/avatars/5.png" alt="User Photo"
                                class="rounded-full w-12 h-12">
                            <div>
                                <span class="font-semibold">John</span>
                                <span class="text-gray-500">adzikrasano@gmail.com</span>
                            </div>
                        </li>
                        <li><a href="http://127.0.0.1:8000/users/show/6"
                                class="block px-4 py-2 text-sm hover:bg-gray-100">Profile</a></li>
                        <li>
                            <a href="http://127.0.0.1:8000/logout" class="block px-4 py-2 text-sm hover:bg-gray-100"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="http://127.0.0.1:8000/logout" method="POST" class="hidden">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>

                <!-- Hamburger Menu -->
                <div class="xl:hidden hamburger-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="profile-header">
            <h1>Profile</h1>
            <button onclick="openEditModal()">Edit Profile</button>
        </div>

        <div class="profile-details flex items-center">
            <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('assets/img/image_not_available.png') }}"
                class="object-cover rounded-full">
            <div>
                <h2>{{ $user->name }}</h2>
                <p>{{ $user->email }}</p>
                <p>Instance: {{ $user->instance->name }}</p>
            </div>
        </div>

        <div class="profile-info mt-4">
            <h3>Personal Information</h3>
            <div class="mt-2">
                <p><strong>Phone:</strong> {{ $user->phone }}</p>
                <p><strong>Address:</strong> {{ $user->address }}</p>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div id="editModal" class="fixed top-0 left-0 w-full h-full hidden items-center justify-center edit-modal">
        <div class="edit-modal-content">
            <h2>Edit Profile</h2>
            <form action="your-action-url" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Form fields -->
                <div class="mt-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" value="{{ $user->name }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div class="mt-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ $user->email }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div class="mt-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" name="phone" id="phone" value="{{ $user->phone }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div class="mt-4">
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" name="address" id="address" value="{{ $user->address }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div class="mt-4">
                    <label for="photo" class="block text-sm font-medium text-gray-700">Photo</label>
                    <input type="file" name="photo" id="photo"
                        class="mt-1 block w-full text-sm text-gray-500">
                </div>

                <!-- Submit Button -->
                <div class="mt-6 flex justify-end">
                    <button type="button" onclick="closeEditModal()"
                        class="mr-3 inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancel
                    </button>
                    <button type="submit"
                        class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <script>
        // Profile dropdown logic
        const profileBtn = document.getElementById('profile-btn');
        const profileMenu = document.getElementById('profile-menu');

        profileBtn.addEventListener('click', () => {
            profileMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', function(event) {
            const isClickInside = profileBtn.contains(event.target) || profileMenu.contains(event.target);
            if (!isClickInside) {
                profileMenu.classList.add('hidden');
            }
        });

        // Edit profile modal logic
        function openEditModal() {
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
</body>

</html>
