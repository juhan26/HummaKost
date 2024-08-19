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
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M8.47365 11.7183C8.11707 12.0749 8.11707 12.6531 8.47365 13.0097L12.071 16.607C12.4615 16.9975 12.4615 17.6305 12.071 18.021C11.6805 18.4115 11.0475 18.4115 10.657 18.021L5.83009 13.1941C5.37164 12.7356 5.37164 11.9924 5.83009 11.5339L10.657 6.707C11.0475 6.31653 11.6805 6.31653 12.071 6.707C12.4615 7.09747 12.4615 7.73053 12.071 8.121L8.47365 11.7183Z"
                    fill-opacity="0.9" />
                <path
                    d="M14.3584 11.8336C14.0654 12.1266 14.0654 12.6014 14.3584 12.8944L18.071 16.607C18.4615 16.9975 18.4615 17.6305 18.071 18.021C17.6805 18.4115 17.0475 18.4115 16.657 18.021L11.6819 13.0459C11.3053 12.6693 11.3053 12.0587 11.6819 11.6821L16.657 6.707C17.0475 6.31653 17.6805 6.31653 18.071 6.707C18.4615 7.09747 18.4615 7.73053 18.071 8.121L14.3584 11.8336Z"
                    fill-opacity="0.4" />
            </svg>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>



    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ url('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons ri-home-3-line"></i>
                <div>Dashboard</div>
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
</aside>

