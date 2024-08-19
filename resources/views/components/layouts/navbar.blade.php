{{-- Template --}}
    <nav class="p-4 border shadow-sm layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center"
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
                            <a class="dropdown-item" href="pages-profile-user.html">
                                <i class="ri-user-3-line ri-22px me-3"></i><span class="align-middle">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="pages-account-settings-account.html">
                                <i class="ri-settings-4-line ri-22px me-3"></i><span class="align-middle">Settings</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="pages-account-settings-billing.html">
                                <span class="d-flex align-items-center align-middle">
                                    <i class="flex-shrink-0 ri-file-text-line ri-22px me-3"></i>
                                    <span class="flex-grow-1 align-middle">Billing</span>
                                    <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger">4</span>
                                </span>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="pages-pricing.html">
                                <i class="ri-money-dollar-circle-line ri-22px me-3"></i><span class="align-middle">Pricing</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="pages-faq.html">
                                <i class="ri-question-line ri-22px me-3"></i><span class="align-middle">FAQ</span>
                            </a>
                        </li>
                        <li>
                            <div class="d-grid px-4 pt-2 pb-1">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="mdi mdi-logout me-2"></i>
                                    <span class="align-middle">{{ __('Logout') }}</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.querySelector('.layout-menu-toggle');
        const layoutPage = document.querySelector('.layout-page');
        const navLink = document.querySelector('.layout-menu-toggle .material-symbols-outlined');
        const menu = document.getElementById('layout-navbar');

        menuToggle.addEventListener('click', function() {
            if (menu.classList.contains('collapsed')) {
                menu.classList.remove('collapsed');
                menu.classList.add('expanded');
                layoutPage.style.paddingLeft = "6.25rem"; // Disesuaikan dengan nilai padding sesuai status menu
                navLink.textContent = 'dock_to_right'; // Mengubah teks ikon sesuai status menu
            } else {
                menu.classList.remove('expanded');
                menu.classList.add('collapsed');
                layoutPage.style.paddingLeft = "16.25rem"; // Disesuaikan dengan nilai padding sesuai status menu
                navLink.textContent = 'dock_to_left'; // Mengubah teks ikon sesuai status menu
            }
        });

        // Script untuk mengubah kelas navbar saat scroll
        window.addEventListener('scroll', function() {
            menu.classList.toggle('bg-white', window.scrollY > 0);
            menu.classList.toggle('border', window.scrollY > 0);
            menu.classList.toggle('p-4', window.scrollY > 0);
            menu.classList.toggle('shadow-sm', window.scrollY > 0);
        });
    });
</script>
