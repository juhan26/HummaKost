<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="Kontrakan Las Vegas" />

    <title>HummaKost</title>

    <!-- favicon -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.7.0/vanilla-tilt.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />

    <link rel="icon" type="image/x-icon" sizes="128x128 " href="/assets/images/logo.png" style="">
    <!-- <link rel="icon" type="image/x-icon" href="./img/favicon-16x16.png"> -->
    <!-- <link rel="shortcut icon" type="image/jpg" href="./img/favicon-16x16.png" /> -->
    <!-- favicon -->


    <!-- css link -->
    <link href="/assets/plugins/css/animate.css" rel="stylesheet">
    <link href="/assets/plugins/css/swipper.css" rel="stylesheet">
    <link href="/assets/plugins/css/aos.css" rel="stylesheet">
    <link href="/assets/css/tailwind.css" rel="stylesheet">
    <link href="/assets/css/styles.css" rel="stylesheet">
    <link href="/assets/css/responsive.css" rel="stylesheet">

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
    <!-- header area -->
    <header id="header-sticky">
        <div class="py-6 bg-white border-b border-gray-50">
            <div class="container flex justify-between items-center px-4 sm:px-6 2xl:px-0">
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
                            href="{{ route('home.index') }}">home</a>
                    </li>
                    <li class="">
                        <a class="menu-link font-display font-semibold text-base leading-6 text-gray-500 hover:text-primary-500 transition duration-500 px-6 py-3"
                            href="#search_people">properties</a>
                    </li>
                    <li class="">
                        <a class="menu-link font-display font-semibold text-base leading-6 text-gray-500 hover:text-primary-500 transition duration-500 px-6 py-3"
                            href="#loadMember">member</a>
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
                <div class="flex items-center gap-6">
                    <a href=""
                        class="flex items-center gap-2 text-base font-display font-medium text-gray-500 hover:text-primary-500 transition duration-500">
                        <span class="flex justify-center items-center">
                        </span>
                        @if (Auth::user())
                            <a href="{{ route('dashboard') }}"
                                class="hidden xl:inline-block btn-primary"><span>{{ 'Dasbor' }}</span></a>
                        @else
                            <a href="{{ route('register') }}"
                                class=" hidden xl:inline-block border hover:bg-primary-500 hover:text-white transition duration-500 text-primary-500"
                                style="padding:12px 16px; border-radius:8px;"><span>{{ 'Daftar' }}</span></a>
                            <a href="{{ route('login') }}"
                                class="hidden xl:inline-block btn-primary"><span>{{ 'Masuk' }}</span></a>
                        @endif
                    </a>
                    {{-- <a href="#" class="hidden xl:inline-block btn-primary">
                        <span>Sign up for Free</span>
                    </a> --}}
                    <div class="xl:hidden inline-block hamburger-btn" id="hamburger-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                <!-- right menu end -->
            </div>
        </div>
    </header>


    <!-- Mobile Menu Area Start -->
    <div class="nav-menu" id="nav-menu">
        <div class="flex justify-center items-center p-6 mb-8">
            <div>
                <a href="#">
                    <img src="/assets/img/images/logo.png" alt="Logo" style="width: 7rem; height: 2rem;"
                        class="container">
                </a>
            </div>
            <div class="absolute right-6">
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
                    href="#search_people">properties</a>
            </li>
            <li class="mb-2">
                <a class="nav-link inline-block font-display font-semibold text-base leading-6 text-gray-500 hover:text-primary-500 transition-all duration-500"
                    href="#loadMember">member</a>
            </li>
            <li class="mb-2">
                <a class="nav-link inline-block font-display font-semibold text-base leading-6 text-gray-500 hover:text-primary-500 transition-all duration-500"
                    href="#descc">about</a>
            </li>
            <li class="mb-2">
                <a class="nav-link inline-block font-display font-semibold text-base leading-6 text-gray-500 hover:text-primary-500 transition-all duration-500"
                    href="#gambars">feedback</a>
            </li>
            <li class="">
                <a class="nav-link inline-block font-display font-semibold text-base leading-6 text-gray-500 hover:text-primary-500 transition-all duration-500"
                    href="#blog">contact</a>
            </li>
        </ul>
        <div class="px-6 mb-8">
            {{-- <a href="#" class="btn-primary">
                <span>Sign up for Free</span>
            </a> --}}
        </div>
    </div>

    <!-- Mobile Menu Area End -->
    <div class="overlay" id="overlay"></div>
    <!-- header area end -->

    <!-- banner area  -->
    <section class="bg-white relative">
        <!-- svg icon start -->
        <span class="absolute animate-bounce left-[240px] top-[102px] hidden 2xl:inline-block">
            <svg width="36" height="36" viewBox="0 0 36 36" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M19.5046 24.6797L16.8046 32.0063C16.7247 32.2216 16.5808 32.4073 16.3923 32.5384C16.2038 32.6695 15.9796 32.7398 15.75 32.7398C15.5203 32.7398 15.2962 32.6695 15.1076 32.5384C14.9191 32.4073 14.7752 32.2216 14.6953 32.0063L11.9953 24.6797C11.9383 24.5251 11.8484 24.3846 11.7319 24.2681C11.6154 24.1516 11.4749 24.0617 11.3203 24.0047L3.99371 21.3047C3.77841 21.2248 3.59273 21.0809 3.4616 20.8924C3.33048 20.7038 3.26019 20.4797 3.26019 20.25C3.26019 20.0204 3.33048 19.7962 3.4616 19.6077C3.59273 19.4191 3.77841 19.2752 3.99371 19.1953L11.3203 16.4953C11.4749 16.4384 11.6154 16.3485 11.7319 16.232C11.8484 16.1154 11.9383 15.975 11.9953 15.8203L14.6953 8.49377C14.7752 8.27847 14.9191 8.09279 15.1076 7.96166C15.2962 7.83054 15.5203 7.76025 15.75 7.76025C15.9796 7.76025 16.2038 7.83054 16.3923 7.96166C16.5808 8.09279 16.7247 8.27847 16.8046 8.49377L19.5046 15.8203C19.5616 15.975 19.6515 16.1154 19.768 16.232C19.8846 16.3485 20.025 16.4384 20.1796 16.4953L27.5062 19.1953C27.7215 19.2752 27.9072 19.4191 28.0383 19.6077C28.1694 19.7962 28.2397 20.0204 28.2397 20.25C28.2397 20.4797 28.1694 20.7038 28.0383 20.8924C27.9072 21.0809 27.7215 21.2248 27.5062 21.3047L20.1796 24.0047C20.025 24.0617 19.8846 24.1516 19.768 24.2681C19.6515 24.3846 19.5616 24.5251 19.5046 24.6797Z"
                    fill="#1A906B" />
                <path d="M24.75 2.25V9" stroke="#1A906B" stroke-width="2.25" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M28.125 5.625H21.375" stroke="#1A906B" stroke-width="2.25" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M31.5 10.125V14.625" stroke="#1A906B" stroke-width="2.25" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M33.75 12.375H29.25" stroke="#1A906B" stroke-width="2.25" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </span>

        <span class="absolute animate-pulse left-[752px] top-[160px] hidden 2xl:inline-block">
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <circle cx="6" cy="6" r="6" fill="#6D39E9" />
            </svg>
        </span>

        <span class="absolute animate-spin right-[926px] top-[120px] hidden 2xl:inline-block">
            <svg width="50" height="50" viewBox="0 0 50 50" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M30.991 29.4259L29.5453 40.3888C29.5087 40.6523 29.3925 40.8983 29.212 41.0937C29.0316 41.2892 28.7957 41.4248 28.5359 41.4822C28.2762 41.5396 28.0051 41.5162 27.7591 41.4151C27.5131 41.3139 27.3039 41.1399 27.1596 40.9164L21.2258 31.5856C21.1226 31.4249 20.9859 31.2886 20.8249 31.1859C20.664 31.0833 20.4827 31.0168 20.2935 30.991L9.33059 29.5453C9.06711 29.5088 8.82111 29.3925 8.62566 29.2121C8.4302 29.0316 8.29465 28.7957 8.2372 28.536C8.17976 28.2762 8.20318 28.0051 8.30432 27.7591C8.40546 27.5131 8.57948 27.3039 8.80298 27.1597L18.1338 21.2258C18.2945 21.1227 18.4308 20.9859 18.5335 20.825C18.6361 20.664 18.7026 20.4827 18.7284 20.2936L20.1741 9.33062C20.2106 9.06714 20.3269 8.82114 20.5073 8.62569C20.6878 8.43023 20.9237 8.29468 21.1834 8.23723C21.4432 8.17979 21.7143 8.20321 21.9603 8.30435C22.2063 8.40549 22.4155 8.5795 22.5597 8.80301L28.4936 18.1339C28.5967 18.2945 28.7335 18.4309 28.8944 18.5335C29.0554 18.6362 29.2367 18.7027 29.4258 18.7284L40.3888 20.1741C40.6523 20.2107 40.8983 20.3269 41.0937 20.5074C41.2892 20.6878 41.4247 20.9237 41.4822 21.1835C41.5396 21.4432 41.5162 21.7143 41.415 21.9603C41.3139 22.2063 41.1399 22.4155 40.9164 22.5598L31.5855 28.4936C31.4249 28.5968 31.2885 28.7335 31.1859 28.8945C31.0832 29.0554 31.0167 29.2367 30.991 29.4259V29.4259Z"
                    fill="#FFC27A" />
            </svg>
        </span>

        <span class="absolute animate-ping right-[21.35%] top-[24px] hidden 2xl:inline-block">
            <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <circle cx="7.5" cy="7.5" r="7.5" fill="#FFC27A" />
            </svg>
        </span>

        <span class="absolute animate-ping  left-[34px] top-[548px] hidden 2xl:inline-block">
            <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <circle cx="5" cy="5" r="5" fill="#ED4459" />
            </svg>
        </span>

        <span class="absolute animate-bounce bottom-[131px] right-[649px] hidden 2xl:inline-block">
            <svg width="15" height="16" viewBox="0 0 15 16" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <circle cx="7.5" cy="8.02197" r="7.5" fill="#6D39E9" />
            </svg>
        </span>
        <!-- svg icon end -->

        <!-- banner wrapper start -->
        <div class="banner-wrapper pb-8 xl:pb-[180px]">
            <div class="container px-4 sm:px-6 2xl:px-0">
                <div class="flex flex-wrap justify-center 2xl:justify-between">
                    <!-- left -->
                    <div class="2xl:pt-[150px] pt-5">
                        <div class="2xl:w-[677px] w-full">
                            <h2 class="font-display text-primary-500 font-semibold 2xl:text-2xl md:text-lg text-sm pb-2 2xl:pb-6"
                                data-aos="fade-down" data-aos-duration="1000">Welcome To
                            </h2>
                            <h1 class="capitalize mb-4 lg:mb-6 font-display font-semibold md:text-3xl text-2xl 2xl:text-[56px] 2xl:leading-[72px] text-primary-900"
                                data-aos="fade-down" data-aos-duration="1000">
                                <span class="text-primary-500 after-svg banner_5000">HummaKost</span>
                                Kontrakan
                                ter- <span class="text-primary-500 after-svg banner_300">Nyaman</span> Harga
                                <span class="text-primary-500 after-svg banner_300">Terjangkau,</span> Segera Miliki!
                            </h1>
                            <p class="text-gray-500 font-normal font-display lg:text-[20px] md:text-base text-sm lg:leading-7 mb-8 pt-4 xl:pt-0"
                                data-aos="fade-down" data-aos-duration="1000"> Lebih dari sekadar Tempat Tinggal, ini
                                Rumah anda.</p>
                            <form action="" data-aos="fade-down" data-aos-duration="1000">
                                <div class="flex justify-between items-center ">
                                    <div class="relative w-full xl:max-w-[648px]">
                                        <input type="text" id="search_people"
                                            class="px-6 py-6 block w-full shadow-[-4px_-4px_44px_rgba(0,0,0,0.08)] rounded focus:outline-none focus:ring-1 focus:ring-primary-500 transition duration-300 ease-in-out"
                                            placeholder="Cari orang di kontrakan ini?">
                                        <span class="absolute top-6 right-6">
                                            <svg class="" width="24" height="24" viewBox="0 0 24 24"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M10.875 18.75C15.2242 18.75 18.75 15.2242 18.75 10.875C18.75 6.52576 15.2242 3 10.875 3C6.52576 3 3 6.52576 3 10.875C3 15.2242 6.52576 18.75 10.875 18.75Z"
                                                    stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M16.4437 16.4437L21 21" stroke="black" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- left -->
                    <!-- right -->
                    <div class="mt-5 2xl:mt-[156px] relative flex justify-center items-center">
                        <div
                            class="2xl:absolute 2xl:right-[-20%] 2xl:top-[-17%] 2xl:h-[444px] 2xl:w-[623px] w-full z-20 flex justify-center items-center pl-10">
                            <img src="/assets/img/images/banner_img.png" alt=""
                                class="transform rotate-[-5deg] translate-x-[-50%] rounded-lg"
                                style="margin-top: 7rem; object-fit: cover; filter: drop-shadow(10px 10px 20px rgba(0, 0, 0, 0.4));"
                                data-aos="fade-in" data-aos-duration="1000">
                        </div>
                        <div
                        class="bg-white xl:px-5 md:px-4 px-2 xl:py-[18px] md:py-2 py-1.5 rounded-lg shadow-2xl flex items-center md:gap-3 gap-2 xl:max-w-[220px] md:max-w-[160px] max-w-[140px] absolute z-50 xl:right-[-90px] right-[10px] xl:top-[73%] top-3/4">
                        <span class="w-16 h-16 md:w-18 md:h-18 xl:w-20 xl:h-20 flex justify-center items-center overflow-hidden">
                            <img src="/assets/img/images/kepala.png" alt="Bapak Kos" class="w-full h-full object-contain">
                        </span>
                        <span class="text-lg md:text-xl xl:text-2xl text-gray-600">Bapak Kos</span>
                    </div>
                    


                        <span
                            class="2xl:absolute 2xl:top-[55px] 2xl:right-[-90px] z-10 animate-pulse hidden 2xl:inline-block">
                            <svg width="133" height="123" viewBox="0 0 133 123" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M129.565 3.0665C122.861 35.2321 103.672 88.7725 3.06598 110.066"
                                    stroke="#A5A5A5" stroke-width="4" stroke-linecap="round"></path>
                            </svg>
                        </span>
                    </div>
                    <!-- right -->
                </div>
            </div>
        </div>
        <!-- banner wrapper end -->

    </section>
    <!-- banner area end -->

    <!-- course area start -->
    <section class="section-padding course-section bg-primary-50/70" id="properties">
        <div class="container px-4 sm:px-6 xl:px-0">
            <div class="xl:flex items-center">
                <div class="xl:w-1/4">
                    <h2
                        class="capitalize font-display font-semibold text-2xl xl:text-[56px] xl:leading-[72px] text-primary-900">
                        Our <span class="text-primary-500 after-svg popular">Properties</span>
                    </h2>
                </div>
                <div class="2xl:w-3/4">
                    <div class="swiper courseSwipper relative">
                        <div class="swiper-wrapper py-4 2xl:pr-[29.3%]">
                            @foreach ($properties->unique('id') as $property)
                                <div class="swiper-slide">
                                    <div class="course-card max-w-xs sm:max-w-sm md:max-w-md lg:max-w-lg">
                                        <div class="bg-gray-white rounded-xl">
                                            <div class="course-content px-4 py-4">
                                                <div class="overflow-hidden rounded-lg inline-block relative">
                                                    <a href="{{ route('home.show', $property->id) }}"
                                                        class="inline-block">
                                                        @if ($property->image)
                                                            <img src="{{ asset('storage/' . $property->image) }}"
                                                                alt="" class="w-full h-full relative">
                                                        @else
                                                            <img src="{{ asset('assets/img/image_not_available.png') }}"
                                                                alt="" class="w-full h-full relative">
                                                        @endif
                                                    </a>
                                                    <p
                                                        class="absolute top-[7px] left-2 z-20 badge text-base text-gray-black px-[13px] py-[6px] rounded-md bg-white/60 ml-2 mt-2">
                                                        Kontrakan
                                                    </p>
                                                </div>
                                                <h4
                                                    class="font-display text-gray-700 text-[20px] leading-7 font-medium mt-4 hover:text-primary-500 transition duration-300 ease-linear">
                                                    <a
                                                        href="{{ route('home.show', $property->id) }}">{{ $property->name }}</a>
                                                </h4>
                                                <div class="flex gap-3 mt-4">
                                                    <ul class="flex gap-2 items-center">
                                                        <p style="color: gray;">{{ $property->description }}</p>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="border-b border-gray-50 h-1 w-full"></div>
                                            <div class="course-info px-4 py-4">
                                                <div class="flex justify-between items-center">
                                                    <h4 class="text-gray-black font-semibold font-display text-2xl"
                                                        id="loadMember">
                                                        {{ 'Rp. ' . number_format($property->rental_price, 0) }}</h4>
                                                    <a href="{{ route('home.show', $property->id) }}"
                                                        class="link bg-gray-white px-[10px] py-[10px] rounded-[8px] shadow-[0px_3px_12px_rgba(75,75,75,0.08)]">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M6 18L18 6" stroke="#6D737A" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M8.25 6H18V15.75" stroke="#6D737A"
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
    
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>    

    {{-- <section class="section-padding course-section bg-primary-50/70">
        <div class="container px-4 sm:px-6 xl:px-0">
            <div class="xl:flex items-center">
                <div class="xl:w-1/4">
                    <h2 class="capitalize font-display font-semibold text-2xl xl:text-[56px] xl:leading-[72px] text-primary-900">
                        Our <span class="text-primary-500 after-svg popular">Properties</span>
                    </h2>
                </div>
                <div class="2xl:w-3/4">
                    <div class="swiper courseSwipper relative">
                        <div class="swiper-wrapper py-4 2xl:pr-[29.3%]">
                            @foreach ($properties->unique('id') as $property)
                                <div class="swiper-slide">
                                    <div class="course-card">
                                        <div class="bg-gray-white rounded-xl">
                                            <div class="course-content px-4 py-4">
                                                <div class="overflow-hidden rounded-lg inline-block relative">
                                                    <a href="{{ route('home.show', $property->id) }}" class="inline-block">
                                                        @if ($property->image)
                                                            <img src="{{ asset('storage/' . $property->image) }}" alt="" class="w-full h-full relative">
                                                        @else
                                                            <img src="{{ asset('assets/img/image_not_available.png') }}" alt="" class="w-full h-full relative">
                                                        @endif
                                                    </a>
                                                    <p class="absolute top-[7px] left-2 z-20 badge text-base text-gray-black px-[13px] py-[6px] rounded-md bg-white/60 ml-2 mt-2">
                                                        Social Media
                                                    </p>
                                                </div>
                                                <h4 class="font-display text-gray-700 text-[20px] leading-7 font-medium mt-4 hover:text-primary-500 transition duration-300 ease-linear">
                                                    <a href="{{ route('home.show', $property->id) }}">{{ $property->name }}</a>
                                                </h4>
                                                <div class="flex gap-3 mt-4">
                                                    <ul class="flex gap-2 items-center">
                                                        <p style="color: gray;">Kontrakan Las Vegas Lorem ipsum dolor sit amet consectetur.</p>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="border-b border-gray-50 h-1 w-full"></div>
                                            <div class="course-info px-4 py-4">
                                                <div class="flex justify-between items-center">
                                                    <h4 class="text-gray-black font-semibold font-display text-2xl">$ {{ $property->price }}</h4>
                                                    <a href="{{ route('home.show', $property->id) }}" class="link bg-gray-white px-[10px] py-[10px] rounded-[8px] shadow-[0px_3px_12px_rgba(75,75,75,0.08)]">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M6 18L18 6" stroke="#6D737A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M8.25 6H18V15.75" stroke="#6D737A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- course area end -->

    <!-- popular category area start -->
    {{-- <section id="about" class="section-padding bg-gray-white">
        <div class="container px-4 sm:px-6 2xl:px-0">
            <div class="pt-8 xl:pt-0">
                <h2
                    class="capitalize font-display font-semibold xl:text-[40px] xl:leading-[48px] md:text-3xl text-2xl text-primary-900 inline-block mb-4">
                    Most <span class="text-primary-500 after-svg popular"> Popular Categorys</span>
                </h2>
                <p class="text-gray-500 font-display xl:text-[20px] leading-7">Various versions have
                    evolved over the years, sometimes by accident,</p>
            </div>
            <div class="flex justify-center flex-wrap gap-6 mt-4 xl:mt-[50px] w-full">

                <!-- item -->
                <div data-aos="fade-down" data-aos-duration="1000">
                    <div
                        class="category-card px-6 py-4  rounded-lg shadow-[0px_3px_12px_rgba(75,75,75,0.08)] w-[312px] transition-all relative duration-300">
                        <div class="category-item flex justify-between items-center">

                            <div class="category-item-left flex items-center gap-4">
                                <span class="left-icon transition-all relative duration-300">
                                    <svg width="38" height="38" viewBox="0 0 38 38" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M17.2188 23.75C18.8583 23.75 20.1875 22.4208 20.1875 20.7812C20.1875 19.1417 18.8583 17.8125 17.2188 17.8125C15.5792 17.8125 14.25 19.1417 14.25 20.7812C14.25 22.4208 15.5792 23.75 17.2188 23.75Z"
                                            stroke="black" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M4.75 33.25L15.1258 22.8743" stroke="#6D737A" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M4.75 33.25L25.457 29.8063C25.6614 29.7714 25.8529 29.6829 26.0119 29.55C26.171 29.417 26.292 29.2442 26.3625 29.0492L29.6875 20.1875L17.8125 8.3125L8.95078 11.6375C8.7555 11.7119 8.58298 11.8359 8.45023 11.9973C8.31748 12.1587 8.22908 12.3519 8.19375 12.5578L4.75 33.25Z"
                                            stroke="#6D737A" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M29.6875 20.1875L33.5914 16.2836C33.7036 16.1731 33.7927 16.0414 33.8535 15.8961C33.9143 15.7509 33.9457 15.595 33.9457 15.4375C33.9457 15.28 33.9143 15.1241 33.8535 14.9789C33.7927 14.8336 33.7036 14.7019 33.5914 14.5914L23.4086 4.40859C23.2981 4.29638 23.1664 4.20728 23.0211 4.14646C22.8759 4.08564 22.72 4.05432 22.5625 4.05432C22.405 4.05432 22.2491 4.08564 22.1039 4.14646C21.9586 4.20728 21.8269 4.29638 21.7164 4.40859L17.8125 8.31249"
                                            stroke="#6D737A" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <a href="#">Design</a>
                            </div>

                            <div class="category-item-right">
                                <a href="#"
                                    class="right-icon bg-gray-white rounded-[8px] text-primary-500 inline-block transition-all relative duration-300">
                                    <svg width="44" height="44" viewBox="0 0 44 44" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="44" height="44" rx="8" fill="none" />
                                        <path d="M16 28L28 16" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M18.25 16H28V25.75" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- item end-->

                <!-- item -->
                <div data-aos="fade-down" data-aos-duration="1000">
                    <div
                        class="category-card px-6 py-4  rounded-lg shadow-[0px_3px_12px_rgba(75,75,75,0.08)] w-[312px] transition-all relative duration-300">
                        <div class="category-item flex justify-between items-center">

                            <div class="category-item-left flex items-center gap-4">
                                <span class="left-icon transition-all relative duration-300">
                                    <svg width="38" height="38" viewBox="0 0 38 38" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17.8125 26.125H13.0625" stroke="#6D737A" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M15.4375 32.0625V26.125" stroke="#6D737A" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M5.34375 26.125V32.0625" stroke="#6D737A" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M9.5 26.125V32.0625" stroke="#6D737A" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M5.34375 29.0938H9.5" stroke="#6D737A" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M31.4688 26.125V32.0625H35.0312" stroke="#6D737A" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M21.375 32.0625V26.125L24.3438 30.2812L27.3125 26.125V32.0625"
                                            stroke="#6D737A" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M7.125 20.1875V5.9375C7.125 5.62256 7.25011 5.32051 7.47281 5.09781C7.69551 4.87511 7.99756 4.75 8.3125 4.75H22.5625L30.875 13.0625V20.1875"
                                            stroke="#6D737A" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M22.5625 4.75V13.0625H30.875" stroke="#6D737A" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <a href="#">Development</a>
                            </div>

                            <div class="category-item-right">
                                <a href="#"
                                    class="right-icon bg-gray-white rounded-[8px] text-primary-500 inline-block transition-all relative duration-300">
                                    <svg width="44" height="44" viewBox="0 0 44 44" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="44" height="44" rx="8" fill="none" />
                                        <path d="M16 28L28 16" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M18.25 16H28V25.75" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- item end-->

                <!-- item -->
                <div data-aos="fade-down" data-aos-duration="1000">
                    <div
                        class="category-card px-6 py-4  rounded-lg shadow-[0px_3px_12px_rgba(75,75,75,0.08)] w-[312px] transition-all relative duration-300">
                        <div class="category-item flex justify-between items-center">

                            <div class="category-item-left flex items-center gap-4">
                                <span class="left-icon transition-all relative duration-300">
                                    <svg width="38" height="38" viewBox="0 0 38 38" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M24.9375 22.5625C30.1842 22.5625 34.4375 18.3092 34.4375 13.0625C34.4375 7.81579 30.1842 3.5625 24.9375 3.5625C19.6908 3.5625 15.4375 7.81579 15.4375 13.0625C15.4375 18.3092 19.6908 22.5625 24.9375 22.5625Z"
                                            stroke="#6D737A" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M31.6617 19.7867L18.2133 6.33826" stroke="#6D737A" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M14.8438 23.1562L13.0625 24.9375" stroke="#6D737A" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M15.5563 14.532L4.17109 30.0585C3.99995 30.2864 3.91762 30.5687 3.93947 30.8528C3.96133 31.1369 4.08587 31.4033 4.28984 31.6023L6.39766 33.7101C6.59662 33.9141 6.86305 34.0386 7.14715 34.0605C7.43125 34.0823 7.71359 34 7.94141 33.8289L23.468 22.4437"
                                            stroke="#6D737A" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <a href="#">Marketing</a>
                            </div>

                            <div class="category-item-right">
                                <a href="#"
                                    class="right-icon bg-gray-white rounded-[8px] text-primary-500 inline-block transition-all relative duration-300">
                                    <svg width="44" height="44" viewBox="0 0 44 44" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="44" height="44" rx="8" fill="none" />
                                        <path d="M16 28L28 16" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M18.25 16H28V25.75" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- item end-->

                <!-- item -->
                <div data-aos="fade-down" data-aos-duration="1000">
                    <div
                        class="category-card px-6 py-4  rounded-lg shadow-[0px_3px_12px_rgba(75,75,75,0.08)] w-[312px] transition-all relative duration-300">
                        <div class="category-item flex justify-between items-center">

                            <div class="category-item-left flex items-center gap-4">
                                <span class="left-icon transition-all relative duration-300">
                                    <svg width="38" height="38" viewBox="0 0 38 38" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M32.0625 10.6875H5.9375C5.28166 10.6875 4.75 11.2192 4.75 11.875V30.875C4.75 31.5308 5.28166 32.0625 5.9375 32.0625H32.0625C32.7183 32.0625 33.25 31.5308 33.25 30.875V11.875C33.25 11.2192 32.7183 10.6875 32.0625 10.6875Z"
                                            stroke="#6D737A" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M24.9375 10.6875V8.3125C24.9375 7.68261 24.6873 7.07852 24.2419 6.63312C23.7965 6.18772 23.1924 5.9375 22.5625 5.9375H15.4375C14.8076 5.9375 14.2035 6.18772 13.7581 6.63312C13.3127 7.07852 13.0625 7.68261 13.0625 8.3125V10.6875"
                                            stroke="#6D737A" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M33.25 18.7477C28.919 21.2525 24.0031 22.5685 19 22.5625C13.9959 22.5755 9.07825 21.259 4.75 18.7477"
                                            stroke="#6D737A" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M17.2188 17.8125H20.7812" stroke="#6D737A" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <a href="#">Business</a>
                            </div>

                            <div class="category-item-right">
                                <a href="#"
                                    class="right-icon bg-gray-white rounded-[8px] text-primary-500 inline-block transition-all relative duration-300">
                                    <svg width="44" height="44" viewBox="0 0 44 44" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="44" height="44" rx="8" fill="none" />
                                        <path d="M16 28L28 16" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M18.25 16H28V25.75" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- item end-->

                <!-- item -->
                <div data-aos="fade-down" data-aos-duration="1000">
                    <div
                        class="category-card px-6 py-4  rounded-lg shadow-[0px_3px_12px_rgba(75,75,75,0.08)] w-[312px] transition-all relative duration-300">
                        <div class="category-item flex justify-between items-center">

                            <div class="category-item-left flex items-center gap-4">
                                <span class="left-icon transition-all relative duration-300">
                                    <svg width="38" height="38" viewBox="0 0 38 38" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.775 8.75781L12.632 6.01172" stroke="#6D737A" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M6.38281 16.1501L3.63672 15.0071" stroke="#6D737A" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M31.6172 16.1501L34.3633 15.0071" stroke="#6D737A" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M24.225 8.75781L25.3679 6.01172" stroke="#6D737A" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M35.625 23.75H2.375" stroke="#6D737A" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M30.875 29.6875H7.125" stroke="#6D737A" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M10.4203 23.75C10.0518 22.4268 9.99429 21.0364 10.2523 19.6873C10.5103 18.3383 11.0769 17.0672 11.9076 15.9734C12.7384 14.8796 13.8109 13.9928 15.0412 13.3823C16.2716 12.7718 17.6265 12.4541 19 12.4541C20.3735 12.4541 21.7284 12.7718 22.9588 13.3823C24.1891 13.9928 25.2616 14.8796 26.0924 15.9734C26.9232 17.0672 27.4897 18.3383 27.7477 19.6873C28.0057 21.0364 27.9482 22.4268 27.5797 23.75"
                                            stroke="#6D737A" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <a href="#">Lifestyle</a>
                            </div>

                            <div class="category-item-right">
                                <a href="#"
                                    class="right-icon bg-gray-white rounded-[8px] text-primary-500 inline-block transition-all relative duration-300">
                                    <svg width="44" height="44" viewBox="0 0 44 44" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="44" height="44" rx="8" fill="none" />
                                        <path d="M16 28L28 16" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M18.25 16H28V25.75" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- item end-->

                <!-- item -->
                <div data-aos="fade-down" data-aos-duration="1000">
                    <div
                        class="category-card px-6 py-4  rounded-lg shadow-[0px_3px_12px_rgba(75,75,75,0.08)] w-[312px] transition-all relative duration-300">
                        <div class="category-item flex justify-between items-center">

                            <div class="category-item-left flex items-center gap-4">
                                <span class="left-icon transition-all relative duration-300">
                                    <svg width="38" height="38" viewBox="0 0 38 38" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M30.875 30.875H7.125C6.49511 30.875 5.89102 30.6248 5.44562 30.1794C5.00022 29.734 4.75 29.1299 4.75 28.5V11.875C4.75 11.2451 5.00022 10.641 5.44562 10.1956C5.89102 9.75022 6.49511 9.5 7.125 9.5H11.875L14.25 5.9375H23.75L26.125 9.5H30.875C31.5049 9.5 32.109 9.75022 32.5544 10.1956C32.9998 10.641 33.25 11.2451 33.25 11.875V28.5C33.25 29.1299 32.9998 29.734 32.5544 30.1794C32.109 30.6248 31.5049 30.875 30.875 30.875Z"
                                            stroke="#6D737A" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M19 24.9375C21.9513 24.9375 24.3438 22.545 24.3438 19.5938C24.3438 16.6425 21.9513 14.25 19 14.25C16.0487 14.25 13.6562 16.6425 13.6562 19.5938C13.6562 22.545 16.0487 24.9375 19 24.9375Z"
                                            stroke="#6D737A" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <a href="#">Photography</a>
                            </div>

                            <div class="category-item-right">
                                <a href="#"
                                    class="right-icon bg-gray-white rounded-[8px] text-primary-500 inline-block transition-all relative duration-300">
                                    <svg width="44" height="44" viewBox="0 0 44 44" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="44" height="44" rx="8" fill="none" />
                                        <path d="M16 28L28 16" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M18.25 16H28V25.75" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- item end-->

                <!-- item -->
                <div data-aos="fade-down" data-aos-duration="1000">
                    <div
                        class="category-card px-6 py-4  rounded-lg shadow-[0px_3px_12px_rgba(75,75,75,0.08)] w-[312px] transition-all relative duration-300">
                        <div class="category-item flex justify-between items-center">

                            <div class="category-item-left flex items-center gap-4">
                                <span class="left-icon transition-all relative duration-300">
                                    <svg width="38" height="38" viewBox="0 0 38 38" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M13.0625 33.25C16.3417 33.25 19 30.5917 19 27.3125C19 24.0333 16.3417 21.375 13.0625 21.375C9.78331 21.375 7.125 24.0333 7.125 27.3125C7.125 30.5917 9.78331 33.25 13.0625 33.25Z"
                                            stroke="#6D737A" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M19 27.3125V5.9375L30.875 9.5V16.625L19 13.0625" stroke="#6D737A"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <a href="#">Music</a>
                            </div>

                            <div class="category-item-right">
                                <a href="#"
                                    class="right-icon bg-gray-white rounded-[8px] text-primary-500 inline-block transition-all relative duration-300">
                                    <svg width="44" height="44" viewBox="0 0 44 44" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="44" height="44" rx="8" fill="none" />
                                        <path d="M16 28L28 16" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M18.25 16H28V25.75" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- item end-->

                <!-- item -->
                <div data-aos="fade-down" data-aos-duration="1000">
                    <div
                        class="category-card px-6 py-4  rounded-lg shadow-[0px_3px_12px_rgba(75,75,75,0.08)] w-[312px] transition-all relative duration-300">
                        <div class="category-item flex justify-between items-center">

                            <div class="category-item-left flex items-center gap-4">
                                <span class="left-icon transition-all relative duration-300">
                                    <svg width="38" height="38" viewBox="0 0 38 38" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M19 19C26.2142 19 32.0625 15.81 32.0625 11.875C32.0625 7.93997 26.2142 4.75 19 4.75C11.7858 4.75 5.9375 7.93997 5.9375 11.875C5.9375 15.81 11.7858 19 19 19Z"
                                            stroke="#6D737A" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M5.9375 11.875V19C5.9375 22.9336 11.7859 26.125 19 26.125C26.2141 26.125 32.0625 22.9336 32.0625 19V11.875"
                                            stroke="#6D737A" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M5.9375 19V26.125C5.9375 30.0586 11.7859 33.25 19 33.25C26.2141 33.25 32.0625 30.0586 32.0625 26.125V19"
                                            stroke="#6D737A" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>

                                </span>
                                <a href="#">Data Science</a>
                            </div>

                            <div class="category-item-right">
                                <a href="#"
                                    class="right-icon bg-gray-white rounded-[8px] text-primary-500 inline-block transition-all relative duration-300">
                                    <svg width="44" height="44" viewBox="0 0 44 44" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="44" height="44" rx="8" fill="none" />
                                        <path d="M16 28L28 16" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M18.25 16H28V25.75" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- item end -->

                <!-- item -->
                <div data-aos="fade-down" data-aos-duration="1000">
                    <div
                        class="category-card px-6 py-4  rounded-lg shadow-[0px_3px_12px_rgba(75,75,75,0.08)] w-[312px] transition-all relative duration-300">
                        <div class="category-item flex justify-between items-center">

                            <div class="category-item-left flex items-center gap-4">
                                <span class="left-icon transition-all relative duration-300">
                                    <svg width="38" height="38" viewBox="0 0 38 38" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.0625 34.4375H24.9375" stroke="#6D737A" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M11.682 24.7891C10.2683 23.6899 9.1233 22.2833 8.33376 20.6759C7.54423 19.0685 7.13087 17.3026 7.125 15.5118C7.09532 9.06957 12.2758 3.71098 18.718 3.56254C21.2112 3.50344 23.6598 4.23081 25.7164 5.64151C27.7731 7.0522 29.3334 9.0746 30.176 11.4219C31.0187 13.7692 31.1009 16.3222 30.4111 18.7188C29.7213 21.1155 28.2944 23.2341 26.3328 24.7743C25.8995 25.1092 25.5485 25.5388 25.3067 26.0302C25.0648 26.5216 24.9386 27.0617 24.9375 27.6094V28.5C24.9375 28.815 24.8124 29.117 24.5897 29.3397C24.367 29.5624 24.0649 29.6875 23.75 29.6875H14.25C13.9351 29.6875 13.633 29.5624 13.4103 29.3397C13.1876 29.117 13.0625 28.815 13.0625 28.5V27.6094C13.0588 27.0659 12.9328 26.5301 12.6938 26.0419C12.4548 25.5537 12.109 25.1255 11.682 24.7891V24.7891Z"
                                            stroke="#6D737A" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M20.2023 8.43127C21.6537 8.67731 22.993 9.36777 24.0352 10.4074C25.0775 11.447 25.7713 12.7844 26.0211 14.2352"
                                            stroke="#6D737A" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>

                                </span>
                                <a href="#">Personal Develop</a>
                            </div>

                            <div class="category-item-right">
                                <a href="#"
                                    class="right-icon bg-gray-white rounded-[8px] text-primary-500 inline-block transition-all relative duration-300">
                                    <svg width="44" height="44" viewBox="0 0 44 44" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="44" height="44" rx="8" fill="none" />
                                        <path d="M16 28L28 16" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M18.25 16H28V25.75" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- item end-->

                <!-- item -->
                <div data-aos="fade-down" data-aos-duration="1000">
                    <div
                        class="category-card px-6 py-4  rounded-lg shadow-[0px_3px_12px_rgba(75,75,75,0.08)] w-[312px] transition-all relative duration-300">
                        <div class="category-item flex justify-between items-center">

                            <div class="category-item-left flex items-center gap-4">
                                <span class="left-icon transition-all relative duration-300">
                                    <svg width="38" height="38" viewBox="0 0 38 38" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.75 19H10.6875L13.0625 15.4375L17.8125 22.5625L20.1875 19H23.75"
                                            stroke="#6D737A" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M4.17109 14.25C4.15625 14.057 4.15625 13.8492 4.15625 13.6563C4.15625 11.8719 4.77448 10.1426 5.90577 8.76266C7.03705 7.38272 8.61149 6.43735 10.3612 6.0874C12.111 5.73746 13.9279 6.00455 15.5029 6.84323C17.0779 7.68192 18.3137 9.04039 19 10.6875V10.6875C19.6863 9.04039 20.9221 7.68192 22.4971 6.84323C24.0721 6.00455 25.889 5.73746 27.6388 6.0874C29.3885 6.43735 30.963 7.38272 32.0942 8.76266C33.2255 10.1426 33.8438 11.8719 33.8438 13.6563C33.8438 23.75 19 32.0625 19 32.0625C19 32.0625 13.0773 28.7375 8.71328 23.75"
                                            stroke="#6D737A" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <a href="#">Helth & Fitness</a>
                            </div>

                            <div class="category-item-right">
                                <a href="#"
                                    class="right-icon bg-gray-white rounded-[8px] text-primary-500 inline-block transition-all relative duration-300">
                                    <svg width="44" height="44" viewBox="0 0 44 44" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="44" height="44" rx="8" fill="none" />
                                        <path d="M16 28L28 16" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M18.25 16H28V25.75" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- item end-->

                <!-- item -->
                <div data-aos="fade-down" data-aos-duration="1000">
                    <div
                        class="category-card px-6 py-4  rounded-lg shadow-[0px_3px_12px_rgba(75,75,75,0.08)] w-[312px] transition-all relative duration-300">
                        <div class="category-item flex justify-between items-center">

                            <div class="category-item-left flex items-center gap-4">
                                <span class="left-icon transition-all relative duration-300">
                                    <svg width="38" height="38" viewBox="0 0 38 38" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M19 22.5625C20.9675 22.5625 22.5625 20.9675 22.5625 19C22.5625 17.0325 20.9675 15.4375 19 15.4375C17.0325 15.4375 15.4375 17.0325 15.4375 19C15.4375 20.9675 17.0325 22.5625 19 22.5625Z"
                                            stroke="#6D737A" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M14.25 11.875C16.2175 11.875 17.8125 10.28 17.8125 8.3125C17.8125 6.34499 16.2175 4.75 14.25 4.75C12.2825 4.75 10.6875 6.34499 10.6875 8.3125C10.6875 10.28 12.2825 11.875 14.25 11.875Z"
                                            stroke="#6D737A" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M29.6875 19C31.655 19 33.25 17.405 33.25 15.4375C33.25 13.47 31.655 11.875 29.6875 11.875C27.72 11.875 26.125 13.47 26.125 15.4375C26.125 17.405 27.72 19 29.6875 19Z"
                                            stroke="#6D737A" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M29.6875 30.875C31.655 30.875 33.25 29.28 33.25 27.3125C33.25 25.345 31.655 23.75 29.6875 23.75C27.72 23.75 26.125 25.345 26.125 27.3125C26.125 29.28 27.72 30.875 29.6875 30.875Z"
                                            stroke="#6D737A" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M8.3125 32.0625C10.28 32.0625 11.875 30.4675 11.875 28.5C11.875 26.5325 10.28 24.9375 8.3125 24.9375C6.34499 24.9375 4.75 26.5325 4.75 28.5C4.75 30.4675 6.34499 32.0625 8.3125 32.0625Z"
                                            stroke="#6D737A" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M17.5602 15.7492L15.6898 11.5632" stroke="#6D737A" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M26.3031 16.5657L22.3844 17.8719" stroke="#6D737A" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M26.882 25.1304L21.8055 21.182" stroke="#6D737A" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M16.343 21.3601L10.9695 26.1398" stroke="#6D737A" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                </span>
                                <a href="#">Finance</a>
                            </div>

                            <div class="category-item-right">
                                <a href="#"
                                    class="right-icon bg-gray-white rounded-[8px] text-primary-500 inline-block transition-all relative duration-300">
                                    <svg width="44" height="44" viewBox="0 0 44 44" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="44" height="44" rx="8" fill="none" />
                                        <path d="M16 28L28 16" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M18.25 16H28V25.75" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- item end-->

                <!-- item -->
                <div data-aos="fade-down" data-aos-duration="1000">
                    <div
                        class="category-card px-6 py-4  rounded-lg shadow-[0px_3px_12px_rgba(75,75,75,0.08)] w-[312px] transition-all relative duration-300">
                        <div class="category-item flex justify-between items-center">

                            <div class="category-item-left flex items-center gap-4">
                                <span class="left-icon transition-all relative duration-300">
                                    <svg width="38" height="38" viewBox="0 0 38 38" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.2812 30.875C13.5767 30.875 15.4375 29.0142 15.4375 26.7188C15.4375 24.4233 13.5767 22.5625 11.2812 22.5625C8.98582 22.5625 7.125 24.4233 7.125 26.7188C7.125 29.0142 8.98582 30.875 11.2812 30.875Z"
                                            stroke="#6D737A" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M26.7188 30.875C29.0142 30.875 30.875 29.0142 30.875 26.7188C30.875 24.4233 29.0142 22.5625 26.7188 22.5625C24.4233 22.5625 22.5625 24.4233 22.5625 26.7188C22.5625 29.0142 24.4233 30.875 26.7188 30.875Z"
                                            stroke="#6D737A" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M15.4375 26.7188H22.5625" stroke="#6D737A" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M1.1875 17.8125H36.8125" stroke="#6D737A" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M5.9375 17.8126L13.2555 7.36256C13.3657 7.20418 13.5129 7.07506 13.6843 6.98637C13.8557 6.89768 14.0461 6.85209 14.2391 6.85355C14.432 6.85501 14.6217 6.90348 14.7918 6.99476C14.9618 7.08603 15.107 7.21737 15.2148 7.3774L18.0055 11.5782C18.1134 11.7436 18.2608 11.8794 18.4345 11.9735C18.6081 12.0675 18.8025 12.1168 19 12.1168C19.1975 12.1168 19.3919 12.0675 19.5655 11.9735C19.7392 11.8794 19.8866 11.7436 19.9945 11.5782L22.7852 7.3774C22.893 7.21737 23.0382 7.08603 23.2082 6.99476C23.3783 6.90348 23.568 6.85501 23.7609 6.85355C23.9539 6.85209 24.1443 6.89768 24.3157 6.98637C24.4871 7.07506 24.6343 7.20418 24.7445 7.36256L32.0625 17.8126"
                                            stroke="#6D737A" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>

                                </span>
                                <a href="#">Teaching</a>
                            </div>

                            <div class="category-item-right">
                                <a href="#"
                                    class="right-icon bg-gray-white rounded-[8px] text-primary-500 inline-block transition-all relative duration-300">
                                    <svg width="44" height="44" viewBox="0 0 44 44" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="44" height="44" rx="8" fill="none" />
                                        <path d="M16 28L28 16" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M18.25 16H28V25.75" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- item end-->
            </div>
        </div>
    </section> --}}
    <!-- popular category area end -->

    <!-- intructor section start -->
    <section id="member" class="section-padding instructor-section bg-secondary-50">
        <div class="container px-4 2xl:px-0">
            <form id="propertyForm" method="GET" action="#loadMember">
                <div class="flex items-center justify-between mb-4">
                    <h2
                        class="text-primary-900 xl:text-[40px] xl:leading-[48px] md:text-3xl text-2xl font-semibold font-display mb-4">
                        <span class="text-primary-500 after-svg instructor">Member</span>
                    </h2>
                    <div class="ml-6 w-40 md:w-52 lg:w-64 relative"> <!-- Menyesuaikan lebar untuk berbagai ukuran layar -->
                        <label for="property" class="sr-only">Select Property:</label>
                        <select id="property" name="property_id"
                            class="block w-full text-primary-900 xl:text-[20px] xl:leading-[24px] md:text-xl text-base font-semibold font-display border border-primary-500 rounded-md py-2 px-3 md:px-4 bg-white appearance-none focus:outline-none focus:ring-2 focus:ring-primary-500"
                            onchange="document.getElementById('memberRedirect').value = '#member'; this.form.submit();">
                            @foreach ($properties as $property)
                                <option value="{{ $property->id }}"
                                    {{ $selectedPropertyId == $property->id ? 'selected' : '' }}>
                                    {{ $property->name }}
                                </option>
                            @endforeach
                        </select>
                        <!-- Custom Arrow -->
                        <svg class="absolute top-1/2 right-3 md:right-4 transform -translate-y-1/2 w-4 md:w-5 h-4 md:h-5 text-gray-500 pointer-events-none"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                        </svg>
                        <input type="hidden" id="memberRedirect" name="redirect" value="">
                    </div>
                </div>
            </form>            

            <div class="flex items-center mb-4">
                <p id="descc" class="text-gray-500 text-xl mb-0">Various versions have evolved over the years,
                    sometimes by accident.</p>
            </div>
            <div class="slider-container mx-auto px-4 2xl:px-0">
                <div class="swiper instructorSwipper relative">
                    <div class="swiper-wrapper 2xl:pr-[22%] lg:py-[50px] py-8">
                        @forelse ($users as $user)
                            <div class="swiper-slide">
                                <div class="p-4 bg-white shadow-sm rounded-2xl instructor-card">
                                    <div class="mb-4 overflow-hidden rounded-lg">
                                        <a href="#">
                                            <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('assets/img/image_not_available.png') }}"
                                                alt="{{ $user->name }}" class="rounded-lg">
                                        </a>
                                    </div>
                                    <div>
                                        <h2 class="mb-1.5 font-display text-xl text-gray-black text-center">
                                            <a href="#">{{ $user->name }}</a>
                                            <span
                                                class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                                {{ $user->lease->status }}
                                            </span>
                                        </h2>
                                        <h4 class="mb-0 text-base font-display text-gray-500 text-center">
                                            <a href="#">
                                                {{ \Carbon\Carbon::parse($user->lease->start_date)->format('d M Y') }}
                                                - {{ \Carbon\Carbon::parse($user->lease->end_date)->format('d M Y') }}
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No users available for this user.</p>
                        @endforelse
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Scroll to #member section if the URL contains #member fragment
        document.addEventListener('DOMContentLoaded', function() {
            if (window.location.hash === '#member') {
                document.getElementById('member').scrollIntoView();
            }
        });
    </script>


    <!-- intructor section end -->

    <!-- achievment section start -->
    <section class="section-padding about-section">
        <div class="container px-4 sm:px-6 2xl:px-0">
            <h2
                class="text-primary-900 xl:text-[40px] xl:leading-[48px] md:text-3xl text-2xl font-semibold font-display mb-8">
                About <span class="text-primary-500 after-svg achievement">Us</span>
            </h2>
            <p class="text-primary-900 md:text-xl text-base xl:mb-[100px] md:mb-8 mb-4">
                Di <a href="#" class=""><i><b class="text-primary-500"> HummaKost</a></i></b>, kami
                percaya bahwa setiap orang berhak mendapatkan hunian yang nyaman dan terjangkau.
                Dengan platform kami, Anda bisa menemukan kontrakan yang sesuai dengan kebutuhan Anda, mulai dari lokasi
                yang strategis hingga fasilitas yang lengkap.

                Kami hadir untuk memudahkan proses pencarian dan penyewaan hunian, menghadirkan berbagai pilihan yang
                beragam dan berkualitas. Dengan sistem yang mudah digunakan, Anda dapat mencari, membandingkan, dan
                menyewa hunian impian Anda dalam waktu singkat.

                Didirikan dengan semangat untuk mengubah cara orang menemukan tempat tinggal, kami terus berinovasi
                untuk memberikan pengalaman terbaik bagi para pencari hunian. Dukungan pelanggan kami siap membantu Anda
                di setiap langkah, memastikan Anda mendapatkan layanan yang terbaik.

                Terima kasih telah mempercayakan pencarian hunian Anda kepada kami. Bersama <a href="#"><i><b
                            class="text-primary-500"> HummaKost</a></i></b>, temukan rumah
                yang sesuai dengan gaya hidup Anda, di lokasi yang Anda inginkan.
                <br><br>
                Sebagai bagian dari komitmen kami untuk memberikan layanan terbaik, <a href="#"><i><b
                            class="text-primary-500"> HummaKost</a></i></b> terus berupaya meningkatkan kualitas dan
                kemudahan dalam menemukan hunian idaman. Kami memahami bahwa setiap orang memiliki kebutuhan dan
                preferensi yang berbeda-beda, oleh karena itu kami menghadirkan berbagai fitur yang dapat membantu Anda
                membuat keputusan yang tepat. Mulai dari filter pencarian yang lebih canggih, hingga rekomendasi hunian
                yang disesuaikan dengan gaya hidup Anda, semua dirancang untuk memberikan pengalaman yang lebih personal
                dan menyenangkan. Kami percaya bahwa dengan terus berinovasi dan mendengarkan kebutuhan Anda, kami dapat
                menjadi mitra terpercaya dalam perjalanan Anda menemukan hunian yang sempurna. Teruslah bersama kami
                dalam mewujudkan hunian impian Anda, karena di <a href="#"><i><b class="text-primary-500">
                            HummaKost</a></i></b>, kepuasan Anda adalah prioritas kami.
            </p>

    </section>

    <section class="section-padding feedback-section">
        <div class="container px-4 sm:px-6 2xl:px-0">
            <h2
                class="text-primary-900 xl:text-[40px] xl:leading-[48px] md:text-3xl text-2xl font-semibold font-display mb-4">
                Member <span class="text-primary-500 after-svg feedback">Feedback</span>
            </h2>
            <p class="text-gray-500 md:text-xl text-base">Various versions have evolved over the years, sometimes by
                accident.</p>
            <!-- Feedback Form -->
            <div class="mt-10">
                <form action="{{ route('feedback.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="message" class="block text-gray-700">Your Feedback</label>
                        <textarea name="message" id="message" rows="4" class="w-full px-3 py-2 border rounded-lg"
                            placeholder="Write your feedback here..."></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="rating" class="block text-gray-700">Rating</label>
                        <select name="rating" id="rating" class="w-full px-3 py-2 border rounded-lg">
                            <option value="5">5 - Excellent</option>
                            <option value="4">4 - Good</option>
                            <option value="3">3 - Average</option>
                            <option value="2">2 - Poor</option>
                            <option value="1">1 - Terrible</option>
                        </select>
                    </div>
                    <button type="submit" class="py-5 underline">
                        Submit Feedback
                    </button>
                </form>
            </div>

        </div>

        <!-- Display Feedbacks -->
        <div class="feedback-container container mt-10 overflow-y-auto h-96 px-4 border border-gray-300 rounded-lg">
            @foreach ($feedbacks as $feedback)
                <div class="feedback-item py-2 border-b border-gray-300 relative">
                    <div class="flex items-center justify-between gap-2.5 mb-2">
                        <div class="flex items-center gap-2.5">
                            <div class="w-10 h-10 rounded-full">
                                <img src="{{ $feedback->user_id ? asset('storage/' . $feedback->user->photo) : asset('assets/img/image_not_available.png') }}"
                                    alt="User Profile Image" class="w-full h-full rounded-full">
                            </div>
                            <div>
                                <h2 class="text-base text-gray-900 font-semibold">
                                    {{ $feedback->user_id ? $feedback->user->name : 'Anonymous' }}
                                </h2>
                                <span class="text-sm text-gray-600">
                                    {{ $feedback->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>

                        <!-- Three-dot menu -->
                        <div class="relative">
                            <button class="text-gray-500 focus:outline-none"
                                onclick="toggleDropdown('dropdown-{{ $feedback->id }}')">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6 10a2 2 0 110-4 2 2 0 010 4zm4 0a2 2 0 110-4 2 2 0 010 4zm4 0a2 2 0 110-4 2 2 0 010 4z">
                                    </path>
                                </svg>
                            </button>
                            <!-- Dropdown menu -->
                            <div id="dropdown-{{ $feedback->id }}"
                                class="hidden absolute right-0 mt-2 w-40 bg-white border border-gray-300 rounded-lg shadow-lg z-10">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Report/Laporkan
                                </a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm text-gray-700">
                            {{ $feedback->message }}
                        </p>
                        <div class="flex items-center mt-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= $feedback->rating ? 'text-yellow-500' : 'text-gray-300' }}"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.975a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.396 2.46a1 1 0 00-.364 1.118l1.287 3.975c.3.921-.755 1.688-1.538 1.118l-3.396-2.46a1 1 0 00-1.175 0l-3.396 2.46c-.782.57-1.838-.197-1.538-1.118l1.287-3.975a1 1 0 00-.364-1.118l-3.396-2.46c-.782-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.975z">
                                    </path>
                                </svg>
                            @endfor
                            <span class="ml-2 text-sm text-gray-600">
                                {{ $feedback->rating }} Stars
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <script>
            function toggleDropdown(dropdownId) {
                var dropdown = document.getElementById(dropdownId);
                if (dropdown.classList.contains('hidden')) {
                    dropdown.classList.remove('hidden');
                } else {
                    dropdown.classList.add('hidden');
                }
            }

            // Close dropdown if clicked outside
            document.addEventListener('click', function(event) {
                var target = event.target;
                var dropdowns = document.querySelectorAll('.relative .dropdown-menu');
                dropdowns.forEach(function(dropdown) {
                    if (!dropdown.parentElement.contains(target)) {
                        dropdown.classList.add('hidden');
                    }
                });
            });
        </script>



    </section>


    <!-- achievment section end -->

    <!-- cta section start -->
    <section class="section-padding cta-section bg-primary-50/70">
        <div class="container px-4 sm:px-6 2xl:px-0">
            <div class="flex flex-col justify-center items-center lg:justify-between pt-20 lg:pt-0 lg:flex-row gap-8">
                <div class="max-w-[660px]">
                    <div class="inline-block relative">
                        <img src="/assets/images/cta-hero.png" alt="" class="relative z-50"
                            style="width: 35rem;">
                        <img src="/assets/images/cta-border.png" alt=""
                            class="absolute left-5 bottom-5 z-20">
                        <span class="absolute -left-[10%] -bottom-[15%] z-50 animate-pulse">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="10" cy="10" r="10" fill="#20B486" />
                            </svg>
                        </span>
                        <span class="absolute left-0 -top-[2%] z-50 animate-spin">
                            <svg width="49" height="50" viewBox="0 0 49 50" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M30.3761 32.2316L25.9355 44.4433C25.8267 44.7364 25.6309 44.9891 25.3743 45.1676C25.1176 45.3461 24.8126 45.4417 24.5 45.4417C24.1874 45.4417 23.8823 45.3461 23.6257 45.1676C23.3691 44.9891 23.1732 44.7364 23.0644 44.4433L18.6238 32.2316C18.5462 32.0211 18.4239 31.83 18.2653 31.6713C18.1067 31.5127 17.9155 31.3904 17.705 31.3128L5.49333 26.8722C5.20029 26.7635 4.94755 26.5676 4.76907 26.311C4.5906 26.0544 4.49493 25.7493 4.49493 25.4367C4.49493 25.1241 4.5906 24.819 4.76907 24.5624C4.94755 24.3058 5.20029 24.1099 5.49333 24.0011L17.705 19.5605C17.9155 19.4829 18.1067 19.3606 18.2653 19.202C18.4239 19.0434 18.5462 18.8522 18.6238 18.6418L23.0644 6.43004C23.1732 6.13699 23.3691 5.88425 23.6257 5.70578C23.8823 5.5273 24.1874 5.43164 24.5 5.43164C24.8126 5.43164 25.1176 5.5273 25.3743 5.70578C25.6309 5.88425 25.8267 6.13699 25.9355 6.43004L30.3761 18.6418C30.4537 18.8522 30.576 19.0434 30.7346 19.202C30.8933 19.3606 31.0844 19.4829 31.2949 19.5605L43.5066 24.0011C43.7997 24.1099 44.0524 24.3058 44.2309 24.5624C44.4093 24.819 44.505 25.1241 44.505 25.4367C44.505 25.7493 44.4093 26.0544 44.2309 26.311C44.0524 26.5676 43.7997 26.7635 43.5066 26.8722L31.2949 31.3128C31.0844 31.3904 30.8933 31.5127 30.7346 31.6713C30.576 31.83 30.4537 32.0211 30.3761 32.2316V32.2316Z"
                                    stroke="#FFC27A" stroke-width="3.0625" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>
                        <span class="absolute left-1/2 -top-1/4 z-50 animate-pulse">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="9" cy="9" r="9" fill="#F9475D" />
                            </svg>
                        </span>
                        <span class="absolute md:right-[-10%] right-0 -top-[15%] z-30 animate-bounce">
                            <svg width="142" height="71" viewBox="0 0 142 71" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M138.639 15.3151C115.288 38.3355 70.996 73.062 80.6323 27.8046C92.6777 -28.7671 47.326 27.3974 27.1228 52.098C28.3533 50.6514 -16.1275 107.058 15.1779 12.019"
                                    stroke="#FFC27A" stroke-width="6" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>
                        <span
                            class="absolute md:-right-[10%] right-[10%] md:bottom-[10%] bottom-[-20%] z-50 animate-ping">
                            <svg width="48" height="49" viewBox="0 0 48 49" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="24" cy="24.9365" r="24" fill="#6D39E9" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="max-w-[660px]" data-aos="fade-down" data-aos-duration="1000">
                    <h2
                        class="text-primary-900 font-display xl:text-[40px] xl:leading-[48px] md:text-3xl lg:text-2xl text-lg font-semibold lg:mb-6 md:mb-4 mb-3">
                        Join <span class="text-primary-500">World's largest</span> learning platform today</h2>
                    <p class="lg:text-2xl text-lg text-primary-900 lg:mb-[50px] font-display mb-4">Start learning by
                        registering for free</p>
                    <div>
                        <a href="#" class="hidden xl:inline-block btn-primary">
                            <span>Login</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- cta section end -->

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

    <!-- all script file -->
    <script>
        VanillaTilt.init(document.querySelectorAll("[data-tilt]"), {
            max: 25,
            speed: 400,
            glare: true,
            "max-glare": 0.5,
        });

        function submitFormAndScroll() {
            var form = document.getElementById('propertyForm');
            var selectedPropertyId = document.getElementById('property').value;

            // Append query parameters to the URL
            var url = new URL(window.location.href);
            url.searchParams.set('property_id', selectedPropertyId);
            url.searchParams.set('redirect', '#member');

            // Scroll to the desired position
            window.scrollTo({
                top: 700,
                behavior: 'smooth'
            });

            // Submit the form with the updated URL
            window.location.href = url.toString();
        }

        // Check if the page was reloaded
        if (performance.navigation.type === 1) {
            // Redirect to the root path
            window.location.href = '/';
        }

        // Scroll to #member section if the URL contains #member fragment
        document.addEventListener('DOMContentLoaded', function() {
            if (window.location.hash === '#member') {
                document.getElementById('member').scrollIntoView();
            }
        });
    </script>

    <script src="/assets/plugins/js/jquery.js"></script>
    <script src="/assets/plugins/js/swipper.js"></script>
    <script src="/assets/plugins/js/waypoint.js"></script>
    <script src="/assets/plugins/js/counter.js"></script>
    <script src="/assets/plugins/js/aos.js"></script>
    <script src="/assets/js/main2.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</body>

</html>
