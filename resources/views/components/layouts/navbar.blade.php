{{-- Template --}}
<nav class="p-4 layout-navbar container-xxl navbar shadow-sm navbar-expand-xl navbar-detached align-items-center"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center">
        <a class="nav-item nav-link" href="javascript:void(0)">
            <span class="material-symbols-outlined">
                dock_to_right
            </span>
        </a>
    </div>
    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('assets/img/avatars/1.png') }}"
                            alt="User Photo" class="rounded-circle avatar-img">
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="pages-account-settings-account.html">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-2">
                                    <div class="avatar avatar-online">
                                        <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('assets/img/avatars/1.png') }}"
                                            alt="User Photo" class="rounded-circle avatar-img">
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-medium d-block small">{{ Auth::user()->name }}</span>
                                    @hasrole('admin')
                                        <small class="text-muted">Admin</small>
                                    @elseif (Auth::user()->hasRole('super_admin'))
                                        <small class="text-muted">Super Admin</small>
                                    @elseif (Auth::user()->hasRole('member'))
                                        <small class="text-muted">Member</small>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('user.show', Auth::user()->id) }}">
                                <i class="ri-user-3-line ri-22px me-3"></i><span class="align-middle">Profil Saya</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="ri-logout-box-line ri-22px me-3"></i><span class="align-middle">Keluar</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                        {{-- <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="ri-logout-box-line ri-22px me-3"></i>
                                <span class="align-middle">Keluar</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li> --}}
                        <li>
                            <div class="d-grid px-4 pt-2 pb-1">

                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Search Small Screens -->
        <div class="navbar-search-wrapper search-input-wrapper  d-none">
            <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..."
                aria-label="Search...">
            <i class="ri-close-fill search-toggler cursor-pointer"></i>
        </div>
    </nav>
    {{-- /Template --}}
