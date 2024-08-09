<aside id="layout-menu" class="layout-menu card menu-vertical menu bg-white bg-menu-theme "
    style="border-right: 1px solid rgba(0,0,0,.1)">

    <div class="app-brand demo ">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <span style="color:var(--bs-primary);">
                    {{-- <svg width="268" height="150" viewBox="0 0 38 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M30.0944 2.22569C29.0511 0.444187 26.7508 -0.172113 24.9566 0.849138C23.1623 1.87039 22.5536 4.14247 23.5969 5.92397L30.5368 17.7743C31.5801 19.5558 33.8804 20.1721 35.6746 19.1509C37.4689 18.1296 38.0776 15.8575 37.0343 14.076L30.0944 2.22569Z"
                            fill="currentColor" />
                        <path
                            d="M30.171 2.22569C29.1277 0.444187 26.8274 -0.172113 25.0332 0.849138C23.2389 1.87039 22.6302 4.14247 23.6735 5.92397L30.6134 17.7743C31.6567 19.5558 33.957 20.1721 35.7512 19.1509C37.5455 18.1296 38.1542 15.8575 37.1109 14.076L30.171 2.22569Z"
                            fill="url(#paint0_linear_2989_100980)" fill-opacity="0.4" />
                        <path
                            d="M22.9676 2.22569C24.0109 0.444187 26.3112 -0.172113 28.1054 0.849138C29.8996 1.87039 30.5084 4.14247 29.4651 5.92397L22.5251 17.7743C21.4818 19.5558 19.1816 20.1721 17.3873 19.1509C15.5931 18.1296 14.9843 15.8575 16.0276 14.076L22.9676 2.22569Z"
                            fill="currentColor" />
                        <path
                            d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z"
                            fill="currentColor" />
                        <path
                            d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z"
                            fill="url(#paint1_linear_2989_100980)" fill-opacity="0.4" />
                        <path
                            d="M7.82901 2.22569C8.87231 0.444187 11.1726 -0.172113 12.9668 0.849138C14.7611 1.87039 15.3698 4.14247 14.3265 5.92397L7.38656 17.7743C6.34325 19.5558 4.04298 20.1721 2.24875 19.1509C0.454514 18.1296 -0.154233 15.8575 0.88907 14.076L7.82901 2.22569Z"
                            fill="currentColor" />
                        <defs>
                            <linearGradient id="paint0_linear_2989_100980" x1="5.36642" y1="0.849138" x2="10.532"
                                y2="24.104" gradientUnits="userSpaceOnUse">
                                <stop offset="0" stop-opacity="1" />
                                <stop offset="1" stop-opacity="0" />
                            </linearGradient>
                            <linearGradient id="paint1_linear_2989_100980" x1="5.19475" y1="0.849139" x2="10.3357"
                                y2="24.1155" gradientUnits="userSpaceOnUse">
                                <stop offset="0" stop-opacity="1" />
                                <stop offset="1" stop-opacity="0" />
                            </linearGradient>
                        </defs>
                    </svg> --}}
                </span>
            </span>
            <span class="app-brand-text demo menu-text fw-semibold ms-2">KONTRAKAN</span>
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
                <div>Members</div>
            </a>
        </li>
        <li class="menu-header mt-5">
            <span class="menu-header-text">Properties</span>
        </li>
        <li class="menu-item {{ request()->routeIs('properties.index') ? 'active' : '' }}">
            <a href="{{ url('/properties') }}" class="menu-link">
                <i class="menu-icon tf-icons ri-home-2-line"></i>
                <div>Properties</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('furnitures.index') ? 'active' : '' }}">
            <a href="{{ url('furnitures') }}" class="menu-link">
                <i class="menu-icon tf-icons ri-hotel-bed-line"></i>
                <div>Furnitures</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('property_furnitures.index') ? 'active' : '' }}">
            <a href="{{ url('property_furnitures') }}" class="menu-link">
                <i class="menu-icon tf-icons ri-sofa-line"></i>
                <div>Property And Furnitures</div>
            </a>
        </li>
        <li class="menu-header mt-5">
            <span class="menu-header-text">Leases</span>
        </li>


        <li class="menu-item {{ request()->routeIs('leases.index') ? 'active' : '' }}">
            <a href="{{ url('leases') }}" class="menu-link">
                <i class="menu-icon tf-icons ri-scales-3-line"></i>
                <div>Leases</div>
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
