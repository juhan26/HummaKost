<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Kontrakan Las Vegas" />
    
    <title>HummaKost</title>

    <!-- favicon -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.7.0/vanilla-tilt.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    {{-- leafletjs --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">

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

    <!-- Mobile Menu Area Start -->
    <div class="nav-menu" id="nav-menu">
        <div class="flex justify-between items-center p-6 mb-8">
            <div>
                <a href="#">
                    <img src="/assets/img/images/logo.png" alt="">
                </a>
            </div>
            <div>
                <button
                    class="hamburger-btn-close bg-[#F7F7F9] text-primary-900 hover:bg-primary-500 w-[44px] h-[44px] rounded-full flex items-center justify-center hover:text-white"
                    id="hamburger-btn-close">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 1L1 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                        <path d="M1 1L11 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>
                </button>
            </div>
        </div>
        <!-- menu -->
        <ul class="flex flex-col capitalize px-6 mb-6">
            <li class="mb-2">
                <a class="nav-link inline-block font-display font-semibold text-base leading-6 text-gray-500 hover:text-primary-500 transition-all duration-500"
                    href="{{ route('home.index') }}">home</a>
            </li>
            <li class="mb-2">
                <a class="nav-link inline-block font-display font-semibold text-base leading-6 text-gray-500 hover:text-primary-500 transition-all duration-500"
                    href="#member">member</a>
            </li>
            <li class="mb-2">
                <a class="nav-link inline-block font-display font-semibold text-base leading-6 text-gray-500 hover:text-primary-500 transition-all duration-500"
                    href="#workprocess">course</a>
            </li>
            <li class="mb-2">
                <a class="nav-link inline-block font-display font-semibold text-base leading-6 text-gray-500 hover:text-primary-500 transition-all duration-500"
                    href="#portfolio">blog</a>
            </li>
            <li class="">
                <a class="nav-link inline-block font-display font-semibold text-base leading-6 text-gray-500 hover:text-primary-500 transition-all duration-500"
                    href="#blog">contact</a>
            </li>
        </ul>
        <div class="px-6 mb-8">
            <a href="#" class="btn-primary">
                <span>Sign up for Free</span>
            </a>
        </div>
    </div>
    <!-- Mobile Menu Area End -->
    <div class="overlay" id="overlay"></div>
    <!-- header area end -->

    <section class="section-padding bg-primary-50/70" style="padding:50px !important;">
        <div class="container mx-auto my-5 p-10 mb-10">
            <div class="flex flex-wrap gap-6">
                <div class="flex flex-col lg:flex-row gap-6 my-2">
                    <div class="w-full lg:w-1/2 rounded-lg">
                        @if ($property->image)
                            <img class="w-full h-auto object-cover rounded-lg" src="{{ asset('storage/' . $property->image) }}"
                                alt="Property image" />
                        @else
                            <img class="w-full h-auto object-cover rounded-lg" src="{{ asset('assets/img/image_not_available.png') }}"
                                alt="Image not available" />
                        @endif
                    </div>
    
                    <div class="w-full lg:w-1/2 rounded-lg">
                        <h3 class="font-bold text-3xl text-gray-800 mt-5 mb-1">{{ $property->name }}</h3>
    
                        @if ($property->gender_target === 'male')
                            <div
                                class="inline-block bg-blue-100 text-blue-400 px-4 py-1 rounded-lg mt-6 mr-3 shadow-sm">
                                <i class="fa-solid fa-person"></i><strong class="ml-3">Laki-Laki</strong>
                            </div>
                        @else
                            <div
                                class="inline-block bg-pink-200 text-pink-400 px-4 py-1 rounded-lg mt-6 mr-3 shadow-sm">
                                <i class="fa-solid fa-person-dress"></i> Perempuan
                            </div>
                        @endif
    
                        <div class="inline-block bg-green-200 text-green-400 px-2 py-1 rounded-lg mt-6 mr-3 shadow-sm">
                            Total Orang:
                            <strong>{{ $property->leases->count() }}</strong>
                        </div>
    
                        <div class="inline-block bg-yellow-100 text-yellow-400 px-2 py-1 rounded-lg mt-6 mr-3 mb-8">
                            Kapasitas: <strong>{{ $property->capacity }}</strong>
                        </div>
    
                        <div class="">
                            <h4 class="font-bold">Ketua:</h4>
    
                            @php
                                $status = false;
                            @endphp
                            @foreach ($property->leases as $lease)
                                @if ($lease->user->hasRole('admin'))
                                    <div
                                        class="inline-block bg-green-200 text-green-400 px-2 py-1 rounded-lg mt-1 mr-3 shadow-sm">
                                        <strong>{{ $lease->user->name }}</strong>
                                    </div>
                                    @php
                                        $status = true;
                                    @endphp
                                @endif
                            @endforeach
    
                            @if ($status == false)
                                <div
                                    class="inline-block bg-red-200 text-red-400 px-5 py-1 rounded-2xl mt-1 mr-3 shadow-sm">
                                    Ketua Tidak Tersedia
                                </div>
                            @endif
    
                            <h2 class="font-bold text-2xl text-primary-500 mt-6">
                                {{ 'Rp. ' . number_format($property->rental_price, 0) . ' / bln' }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="container mx-auto mt-10">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Daftar Anggota</h3>
            <div class="swiper-container relative">
                <div class="swiper-wrapper py-4">
                    @forelse ($property->leases as $lease)
                        <div class="swiper-slide" data-aos="fade-up" data-aos-duration="1000">
                            <div class="max-w-xs min-h-[400px] flex flex-col">
                                <div
                                    class="bg-white rounded-lg border-2 border-transparent hover:border-blue-500 transition p-4 flex flex-col items-center">
                                    <div class="overflow-hidden rounded-full inline-block relative">
                                        <img class="w-24 h-24 rounded-full mb-2 object-cover"
                                            src="{{ $lease->user->photo ? asset('storage/' . $lease->user->photo) : asset('assets/img/image_not_available.png') }}"
                                            alt="{{ $lease->user->name }}">
                                    </div>
                                    <h4
                                        class="font-display text-gray-700 text-[20px] leading-7 font-medium mt-4 hover:text-primary-500 transition duration-300 ease-linear">
                                        {{ $lease->user->name }}
                                    </h4>
                                    <p class="text-gray-600">{{ $lease->user->status }}</p>
                                    <a href="#"
                                        class="mt-2 text-green-500 border border-green-500 rounded-full px-4 py-1 text-sm transition">Detail</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="swiper-slide text-center text-black">Belum ada anggota</div>
                    @endforelse
                </div>
                <div class="swiper-button-next" style="background: none; color: #20B486"></div>
                <div class="swiper-button-prev" style="background: none; color: #20B486"></div>
            </div>
        </div>
    
        <div class="container mx-auto mt-10">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Daftar Fasilitas</h3>
            <div class="swiper-container relative">
                <div class="swiper-wrapper py-4">
                    @forelse ($property->facilities as $facility)
                        <div class="swiper-slide" data-aos="fade-up" data-aos-duration="1000">
                            <div class="max-w-xs min-h-[400px] flex flex-col">
                                <div
                                    class="bg-white rounded-lg border-2 border-transparent hover:border-blue-500 transition p-4 flex items-center">
                                    <img class="w-16 h-16 mr-4 rounded-lg object-cover"
                                        src="{{ $facility->photo ? asset('storage/' . $facility->photo) : asset('/assets/img/image_not_available.png') }}"
                                        alt="{{ $facility->name }}">
                                    <div>
                                        <h4
                                            class="font-display text-gray-700 text-[20px] leading-7 font-medium mt-4 hover:text-primary-500 transition duration-300 ease-linear">
                                            {{ $facility->name }}
                                        </h4>
                                        <p class="text-gray-600">{{ $facility->description }}</p>
                                        <a href="#"
                                            class="mt-2 text-green-500 border border-green-500 rounded-full px-4 py-1 text-sm transition">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="swiper-slide text-center text-black">Belum ada fasilitas</div>
                    @endforelse
                </div>
                <div class="swiper-button-next" style="background: none; color: #20B486; width: 40px; height: 40px; padding: 5px;"></div>
                <div class="swiper-button-prev" style="background: none; color: #20B486; width: 40px; height: 40px; padding: 5px;"></div>
                
            </div>
        </div>
    
        <!-- Mengimpor Swiper CSS dan JS -->
        <link rel="stylesheet" href="https://unpkg.com/swiper@10/swiper-bundle.min.css" />
        <script src="https://unpkg.com/swiper@10/swiper-bundle.min.js"></script>
        <script>
            const swiperMembers = new Swiper('.swiper-container:nth-of-type(1)', {
                slidesPerView: 1,
                spaceBetween: 20,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2
                    },
                    768: {
                        slidesPerView: 3
                    },
                    1024: {
                        slidesPerView: 4
                    },
                },
            });
    
            const swiperFacilities = new Swiper('.swiper-container:nth-of-type(2)', {
                slidesPerView: 1,
                spaceBetween: 20,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2
                    },
                    768: {
                        slidesPerView: 3
                    },
                    1024: {
                        slidesPerView: 4
                    },
                },
            });
        </script>
    
        <div class="container mx-auto mt-10">
            <div class="w-full bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="map-container relative" style="z-index: 0;">
                    <div style="width: 100%; height: 500px;" id="map"></div>
                </div>
            </div>
        </div>
    </section>

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

    <link rel="stylesheet" href="https://unpkg.com/swiper@10/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper@10/swiper-bundle.min.js"></script>

    <script>
        const swiperMembers = new Swiper('.swiper-container:nth-of-type(1)', {
            slidesPerView: 3,
            spaceBetween: 20,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2
                },
                768: {
                    slidesPerView: 3
                },
                1024: {
                    slidesPerView: 4
                },
            },
        });

        const swiperFacilities = new Swiper('.swiper-container:nth-of-type(2)', {
            slidesPerView: 1,
            spaceBetween: 20,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                },
            },
        });
    </script>

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
