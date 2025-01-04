<!-- Sidebar -->
<div class="d-flex flex-column flex-shrink-0 text-bg-dark" id="sidebar" style="width: 280px;">
    <!-- Toggle Button -->
    <button class="btn toggle-menu-btn d-md-none d-lg-block mb-2" type="button" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
        <span class="toggle-icon"></span>
        <span class="toggle-icon"></span>
        <span class="toggle-icon"></span>
    </button>

    <!-- Offcanvas Sidebar -->
    <div class="offcanvas offcanvas-start d-md-block text-bg-dark" id="offcanvasSidebar" tabindex="-1"
        aria-labelledby="offcanvasSidebarLabel" style="width: 280px;">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasSidebarLabel">Admin Panel</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column">
            <!-- Logo and Admin Title -->
            <a href="#" class="d-flex align-items-center mb-3 text-white text-decoration-none">
                <img style="background-color: white; border-radius: 20%; margin-right: 3px" width="40"
                    height="32" src="{{ asset('assets/images/Logo.png') }}" alt="Logo" />
                <span class="fs-4">Admin</span>
            </a>
            <hr>

            <!-- Navigation Links -->
            <ul class="nav nav-pills flex-column mb-auto">
                <!-- Home -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-gauge-high"></i> Home
                    </a>
                </li>

                <!-- Project Management Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white {{ request()->routeIs('admin.projects', 'admin.modules') ? 'active' : '' }}"
                        href="#" id="projectsDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-solid fa-diagram-project"></i> Project Management
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="projectsDropdown">
                        <li><a class="dropdown-item" href="{{ route('admin.projects') }}">Projects</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.modules') }}">Modules</a></li>
                    </ul>
                </li>

                <!-- People Management Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white {{ request()->routeIs('admin.client', 'admin.testimonials') ? 'active' : '' }}"
                        href="#" id="peopleDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-solid fa-users"></i> People
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="peopleDropdown">
                        <li><a class="dropdown-item" href="{{ route('admin.client') }}">Clients</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.testimonials') }}">Our Team</a></li>
                    </ul>
                </li>

                <!-- Contact Management Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white {{ request()->routeIs('admin.contacts', 'admin.contacts.filters') ? 'active' : '' }}"
                        href="#" id="contactDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-solid fa-address-book"></i> Contact Management
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="contactDropdown">
                        <li><a class="dropdown-item" href="{{ route('admin.contacts') }}">Contact List</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.contacts.filters') }}">Contact Filters</a>
                        </li>
                    </ul>
                </li>

                <!-- Email Management Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white {{ request()->routeIs('admin.manage-emails', 'mail.config', 'admin.emails.create', 'admin.companies') ? 'active' : '' }}"
                        href="#" id="emailDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-solid fa-envelope"></i> Email Management
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="emailDropdown">
                        <li><a class="dropdown-item" href="{{ route('admin.manage-emails') }}">Email</a></li>
                        <li><a class="dropdown-item" href="{{ route('mail.config') }}">Email Config</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.emails.create') }}">Create Email</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('admin.companies') }}">Companies</a></li>
                    </ul>
                </li>

                <!-- Settings Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white {{ request()->routeIs('admin.settings', 'admin.users') ? 'active' : '' }}"
                        href="#" id="settingsDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-solid fa-gear"></i> Settings
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="settingsDropdown">
                        <li><a class="dropdown-item" href="{{ route('admin.users') }}">User Data</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.settings') }}">General Settings</a></li>
                    </ul>
                </li>

                <!-- Swiper (Kept as single item as per original) -->
                <li>
                    <a href="{{ route('admin.swiper') }}"
                        class="nav-link text-white {{ request()->routeIs('admin.swiper') ? 'active' : '' }}">
                        <i class="fa-solid fa-images"></i> Swiper
                    </a>
                </li>
            </ul>
            <hr>

            <!-- Dropdown Profile Menu -->
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset(auth()->user()->photo) }}" alt="{{ auth()->user()->name }}" width="32"
                        height="32" class="rounded-circle me-2">
                    <strong>{{ auth()->user()->name }}</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li>
                        <button type="button" class="dropdown-item" data-bs-toggle="modal"
                            data-bs-target="#updateProfileModal">
                            Update Profile
                        </button>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Sign out</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
