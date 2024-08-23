<style>
    #layout-navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background-color: white;
        border-radius: 0;
        object-fit: contain;
        max-width: 100%;
        margin: 0 auto;
        align-self: end;
        z-index: 1000;
        transition: ease-in .3s;
    }

    @media screen and (min-width: 567px) {

        #layout-navbar {
            position: fixed;
            top: 0;
            left: 16.25rem;
            width: 100%;
            background-color: white;
            border-radius: 0;
            object-fit: contain;
            max-width: calc(100% - 16.25rem);
            margin: 0 auto;
            align-self: end;
            z-index: 1000;
            transition: ease-in .3s;
        }

        .layout-page {
            padding-top: 4rem;
            position: relative;
        }

        .layout-menu.expanded {
            width: 16.25rem;
            transition: ease-in .3s;
        }

        .layout-menu.collapsed {
            width: 4.5rem;
            overflow: hidden;
            transition: ease-out .3s;
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

        .menu-item .menu-icon span {
            color: #20b486;
        }

        .menu-item.active .menu-icon span {
            color: #fff;
        }
    }
</style>

<aside id="layout-menu" class="layout-menu card menu-vertical menu bg-menu-theme" style="border-radius: 0; z-index: 999">


    <div class="app-brand demo">
        <a href="{{ route('home.index') }}" class="app-brand-link">
            <div class="app-brand-logo demo d-flex justify-content-center align-items-center gap-2">
                <img style="width: 30px" src="/assets/images/logo.png" alt="">
                <div class="app-brand-text demo menu-text fw-semibold">
                    {{ env('APP_NAME', 'HummaKost') }}
                </div>
            </div>
        </a>


    </div>

    <div class="menu-inner-shadow"></div>



    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-header mt-5">
            <span class="menu-header-text">Menu</span>
        </li>
        <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ url('dashboard') }}" class="menu-link" data-bs-toggle="tooltip" data-bs-html="true"
                title='Dashboard' data-popup="tooltip-custom" data-bs-placement="top">
                <div class="menu-icon"><span class="material-symbols-outlined">dashboard</span></div>
                <div>Dasbor</div>

            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('user.index') ? 'active' : '' }}">
            <a href="{{ url('users') }}" class="menu-link">
                <div class="menu-icon"><span class="material-symbols-outlined">group</span></div>
                <div>Anggota</div>
            </a>
        </li>
        <li class="menu-header mt-5">
            <span class="menu-header-text">Kontrakan</span>
        </li>
        <li
            class="menu-item {{ request()->routeIs('properties.index') ? 'active' : '' }} || {{ request()->routeIs('properties.show') ? 'active' : '' }} || {{ request()->routeIs('properties.edit') ? 'active' : '' }} || {{ request()->routeIs('properties.create') ? 'active' : '' }}">
            <a href="{{ url('/properties') }}" class="menu-link">
                <div class="menu-icon"><span class="material-symbols-outlined">cottage</span></div>
                <div>Kontrakan</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('facilities.index') ? 'active' : '' }}">
            <a href="{{ url('facilities') }}" class="menu-link">
                <div class="menu-icon"><span class="material-symbols-outlined">real_estate_agent</span></div>
                <div>Fasilitas</div>

            </a>
        </li>
        @hasrole('admin|super_admin')
            <li class="menu-item {{ request()->routeIs('leases.index') ? 'active' : '' }}">
                <a href="{{ url('leases') }}" class="menu-link">
                    <div class="menu-icon"><span class="material-symbols-outlined">contract</span></div>
                    <div>Kontrak</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('payments.index') ? 'active' : '' }}">
                <a href="{{ url('payments') }}" class="menu-link">
                    <div class="menu-icon"><span class="material-symbols-outlined">payments</span></div>
                    <div>Pembayaran</div>
                </a>
            </li>
            <li class="menu-header mt-5">
                <span class="menu-header-text">Info Lainnya</span>
            </li>
            <li class="menu-item {{ request()->routeIs('instance.index') ? 'active' : '' }}">
                <a href="{{ url('instance') }}" class="menu-link">
                    <div class="menu-icon"><span class="material-symbols-outlined">school</span></div>
                    <div>instansi</div>
                </a>
            </li>
        @endhasrole
        {{-- <li class="menu-item {{ request()->routeIs('property_furnitures.index') ? 'active' : '' }}">
            <a href="{{ url('property_furnitures') }}" class="menu-link">
                <i class="menu-icon tf-icons ri-sofa-line"></i>
                <div>Kontrakan dan Perabotan</div>
            </a>
        </li> --}}







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
            const menuHeader = document.querySelectorAll('.menu-header span');
            const originalHeadersText = Array.from(menuHeader).map(header => header.textContent);


            menuToggle.addEventListener('click', function() {
                if (menu.classList.contains('collapsed')) {
                    menu.classList.add('expanded');
                    menu.classList.remove('collapsed');
                    navLink.classList.remove('text-primary');
                    navLink.textContent = 'dock_to_right'
                    layoutPage.style.paddingLeft = "16.25rem"
                    navbar.style.left = "16.25rem"
                    navbar.style.maxWidth = "calc(100% - 16.25rem)";
                    menuHeader.forEach((header, index) => {
                        header.textContent = originalHeadersText[index]
                    });
                } else {
                    menu.classList.add('collapsed');
                    menu.classList.remove('expanded');
                    navLink.classList.add('text-primary');
                    menuHeader.forEach(header => {
                        header.textContent =
                            '...';
                    });
                    navLink.textContent = 'dock_to_left'
                    layoutPage.style.paddingLeft = "6.25rem"
                    navbar.style.left = "4.5rem"
                    navbar.style.maxWidth = "calc(100% - 4.5rem)";
                }
            });
        });
    </script>
</aside>
