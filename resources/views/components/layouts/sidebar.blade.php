<style>
    /* Navbar fixed to the top */
    #layout-navbar {
        position: fixed;
        /* Make navbar fixed */
        top: 0;
        /* Stick to the top */
        left: 16.25rem;
        /* Align to the left of the viewport */
        width: 100%;
        /* Full width of the viewport */
        background-color: white;
        /* Background color */
        border-radius: 0;
        /* No border radius */
        object-fit: contain;
        /* Ensure proper fitting */
        max-width: calc(100% - 19.25rem);
        margin: 0 auto;
        align-self: end;
        /* Max width is 100% */
        z-index: 1000;
        transition: ease-in .3s;
        /* Ensure it's above other content */
    }

    /* Add padding to the top of the page to prevent content from being hidden behind the fixed navbar */
    .layout-page {
        padding-top: 4rem;
        /* Adjust this value according to the height of the navbar */
        position: relative;
    }

    /* Styles for the menu in its expanded state */
    .layout-menu.expanded {
        width: 16.25rem;
        transition: ease-in .3s;
    }

    /* Styles for the menu in its collapsed state */
    .layout-menu.collapsed {
        width: 5rem;
        overflow: hidden;
        transition: ease-out .3s;
    }

    .layout-menu.collapsed .menu-header {
        display: none;
    }

    .layout-menu.collapsed .app-brand-link .app-brand-text {
        display: none;
    }

    .menu-item {
        transition: ease-in .3s;
    }

    .menu-item .menu-link {
        transition: ease-in .3s;
    }

    .layout-menu.collapsed .menu-item {
        width: 100%;
    }

    .layout-menu.collapsed .menu-item .menu-link {
        display: flex;
        justify-content: start;
        align-items: center;
        padding: 10px;
    }

    .layout-menu.collapsed .menu-item .menu-icon {
        display: block;
    }

    .layout-menu.collapsed .menu-item div {
        display: none;
    }
</style>

<aside id="layout-menu" class="layout-menu card menu-vertical menu bg-white bg-menu-theme "
    style="border-right: 1px solid rgba(0,0,0,.1);border-radius: 0">


    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <div class="app-brand-logo demo d-flex justify-content-center align-items-center gap-2">
                <img style="width: 30px" src="/assets/images/logo.png" alt="">
                <div class="app-brand-text demo menu-text fw-semibold">
                    {{ env('APP_NAME', 'HummaKost') }}
                </div>
            </div>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M11.4854 4.88844C11.0081 4.41121 10.2344 4.41121 9.75715 4.88844L4.51028 10.1353C4.03297 10.6126 4.03297 11.3865 4.51028 11.8638L9.75715 17.1107C10.2344 17.5879 11.0081 17.5879 11.4854 17.1107C11.9626 16.6334 11.9626 15.8597 11.4854 15.3824L7.96672 11.8638C7.48942 11.3865 7.48942 10.6126 7.96672 10.1353L11.4854 6.61667C11.9626 6.13943 11.9626 5.36568 11.4854 4.88844Z"
                    fill="currentColor" fill-opacity="0.6" />
                <path
                    d="M15.8683 4.88844L10.6214 10.1353C10.1441 10.6126 10.1441 11.3865 10.6214 11.8638L15.8683 17.1107C16.3455 17.5879 17.1192 17.5879 17.5965 17.1107C18.0737 16.6334 18.0737 15.8597 17.5965 15.3824L14.0778 11.8638C13.6005 11.3865 13.6005 10.6126 14.0778 10.1353L17.5965 6.61667C18.0737 6.13943 18.0737 5.36568 17.5965 4.88844C17.1192 4.41121 16.3455 4.41121 15.8683 4.88844Z"
                    fill="currentColor" fill-opacity="0.38" />
            </svg>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>



    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ url('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons ri-home-3-line"></i>
                <div><span class="material-symbols-outlined">home</span></div>
            </a>
        </li>
        <li class="menu-header mt-5">
            <span class="menu-header-text">members</span>
        </li>
        <li class="menu-item {{ request()->routeIs('user.index') ? 'active' : '' }}">
            <a href="{{ url('users') }}" class="menu-link">
                <i class="menu-icon tf-icons ri-group-line"></i>
                <div>Pengguna</div>
            </a>
        </li>
        <li class="menu-header mt-5">
            <span class="menu-header-text">Kontrakan</span>
        </li>
        <li
            class="menu-item {{ request()->routeIs('properties.index') ? 'active' : '' }} || {{ request()->routeIs('properties.show') ? 'active' : '' }}">
            <a href="{{ url('/properties') }}" class="menu-link">
                <i class="menu-icon tf-icons ri-home-2-line"></i>
                <div>Kontrakan</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('facilities.index') ? 'active' : '' }}">
            <a href="{{ url('facilities') }}" class="menu-link">
                <i class="menu-icon tf-icons ri-hotel-bed-line"></i>
                <div>Fasilitas</div>
            </a>
        </li>
        <li class="menu-header mt-5">
            <span class="menu-header-text">SEKOLAH</span>
        </li>
        <li class="menu-item {{ request()->routeIs('instance.index') ? 'active' : '' }}">
            <a href="{{ url('instance') }}" class="menu-link">
                <i class="menu-icon tf-icons ri-school-line"></i>
                <div>sekolah</div>
            </a>
        </li>
        {{-- <li class="menu-item {{ request()->routeIs('property_furnitures.index') ? 'active' : '' }}">
            <a href="{{ url('property_furnitures') }}" class="menu-link">
                <i class="menu-icon tf-icons ri-sofa-line"></i>
                <div>Kontrakan dan Perabotan</div>
            </a>
        </li> --}}
        <li class="menu-header mt-5">
            <span class="menu-header-text">Kontrak</span>
        </li>


        <li class="menu-item {{ request()->routeIs('leases.index') ? 'active' : '' }}">
            <a href="{{ url('leases') }}" class="menu-link">
                <i class="menu-icon tf-icons ri-scales-3-line"></i>
                <div>Kontrak</div>
            </a>
        </li>

        <li class="menu-header mt-5">
            <span class="menu-header-text">Pembayaran</span>
        </li>


        <li class="menu-item {{ request()->routeIs('payments.index') ? 'active' : '' }}">
            <a href="{{ url('payments') }}" class="menu-link">
                <i class="menu-icon tf-icons ri-money-dollar-circle-line"></i>
                <div>Pembayaran Perbulan</div>
            </a>
        </li>




        <!-- Apps & Pages -->

        {{--
        <li class="menu-item {{ request()->routeIs('members') ? 'active' : '' }}">
            <a href="{{ url('anggota') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-account-group"></i>
                <div>Daftar anggota</div>
            </a>
        </li>
        <li class="menu-header mt-5">
            <span class="menu-header-text" data-i18n="Apps & Pages">Keuangan</span>
        </li>
        <li class="menu-item {{ request()->routeIs('financials') ? 'active' : '' }}">
            <a href="{{ url('keuangan') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-cash-multiple"></i>
                <div>Info Kas</div>
            </a>
        </li>
        @hasrole('member')
        <li class="menu-item {{ request()->routeIs('incomes') ? 'active' : '' }}">
            <a href="{{ url('bayarkas') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-cash-plus"></i>
                <div>Bayar Kas</div>
            </a>
        </li>
        @endhasrole
        @hasrole('admin')
        <li class="menu-item {{ request()->routeIs('incomes') ? 'active' : '' }}">
            <a href="{{ url('bayarkas') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-cash-plus"></i>
                <div>Pemasukan</div>
            </a>
        </li>
            <li class="menu-item {{ request()->routeIs('expenses') ? 'active' : '' }}">
                <a href="{{ url('pengeluaran') }}" class="menu-link">
                    <i class="menu-icon tf-icons mdi mdi-cash-minus"></i>
                    <div data-i18n="Chat">Pengeluaran</div>
                </a>
            </li>
        @endhasrole --}}
    </ul>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.querySelector('.layout-navbar .layout-menu-toggle');
            const layoutPage = document.querySelector('.layout-page');
            const navLink = document.querySelector('.navbar-nav .nav-link .material-symbols-outlined');
            const navbar = document.querySelector('#layout-navbar');
            const menu = document.getElementById('layout-menu');

            menuToggle.addEventListener('click', function() {
                if (menu.classList.contains('collapsed')) {
                    menu.classList.remove('collapsed');
                    menu.classList.add('expanded');
                    layoutPage.style.paddingLeft = "16.25rem"
                    navLink.textContent = 'dock_to_right'
                    navbar.style.left = "16.25rem"
                    navbar.style.maxWidth = "calc(100% - 19.25rem)";
                } else {
                    menu.classList.remove('expanded');
                    menu.classList.add('collapsed');
                    layoutPage.style.paddingLeft = "6.25rem"
                    navLink.textContent = 'dock_to_left'
                    navbar.style.left = "6.25rem"
                    navbar.style.maxWidth = "calc(100% - 9.25rem)";
                }
            });
        });
    </script>
</aside>

