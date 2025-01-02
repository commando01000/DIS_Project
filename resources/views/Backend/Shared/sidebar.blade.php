<!-- Sidebar -->
<div class="d-flex flex-column flex-shrink-0 text-bg-dark" id="sidebar" style="width: 280px;">
    <!-- Toggle Button -->
    <button class="btn toggle-menu-btn d-md-none d-lg-block mb-2" type="button" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
        <span class="toggle-icon"></span>
        <span class="toggle-icon"></span>
        <span class="toggle-icon"></span>
    </button>

    <div class="offcanvas offcanvas-start d-md-block text-bg-dark" id="offcanvasSidebar" tabindex="-1"
        aria-labelledby="offcanvasSidebarLabel" style="width: 280px;">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasSidebarLabel">Admin Panel</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column justify-content-between custom-scrollbar">
            <!-- Logo -->
            <a href="#" class="d-flex align-items-center mb-3 text-white text-decoration-none">
                <img style="background-color: white; border-radius: 20%; margin-right: 3px" width="40"
                    height="32" src="{{ asset('assets/images/Logo.png') }}" alt="Logo" />
                <span class="fs-4">Admin</span>
            </a>
            <hr>
            
            <!-- Navigation -->
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-gauge-high"></i> Home
                    </a>
                </li>

                <!-- Project Management Section -->
                <li class="nav-item">
                    <a href="#" class="nav-link text-white" onclick="toggleSidebarSection('project-management')">
                        <i class="fa-solid fa-diagram-project"></i> Project Management
                    </a>
                    <ul class="nav flex-column ms-3 d-none" id="project-management">
                        <li>
                            <a href="{{ route('admin.projects') }}"
                                class="nav-link text-white {{ request()->routeIs('admin.projects') ? 'active' : '' }}">
                                <i class="fa-solid fa-list-check"></i> Projects
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.modules') }}"
                                class="nav-link text-white {{ request()->routeIs('admin.modules') ? 'active' : '' }}">
                                <i class="fa-solid fa-cubes"></i> Modules
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.companies') }}"
                                class="nav-link text-white {{ request()->routeIs('admin.companies') ? 'active' : '' }}">
                                <i class="fa-solid fa-building"></i> Companies
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- People Section -->
                <li class="nav-item">
                    <a href="#" class="nav-link text-white" onclick="toggleSidebarSection('people-section')">
                        <i class="fa-solid fa-users"></i> People
                    </a>
                    <ul class="nav flex-column ms-3 d-none" id="people-section">
                        <li>
                            <a href="{{ route('admin.client') }}"
                                class="nav-link text-white {{ request()->routeIs('admin.client') ? 'active' : '' }}">
                                <i class="fa-solid fa-user-tie"></i> Clients
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.testimonials') }}"
                                class="nav-link text-white {{ request()->routeIs('admin.testimonials') ? 'active' : '' }}">
                                <i class="fa-solid fa-people-group"></i> Our Team
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Contact Management Section -->
                <li class="nav-item">
                    <a href="#" class="nav-link text-white" onclick="toggleSidebarSection('contact-section')">
                        <i class="fa-solid fa-address-book"></i> Contact Management
                    </a>
                    <ul class="nav flex-column ms-3 d-none" id="contact-section">
                        <li>
                            <a href="{{ route('admin.contacts') }}"
                                class="nav-link text-white {{ request()->routeIs('admin.contacts') ? 'active' : '' }}">
                                <i class="fa-solid fa-envelope"></i> Contact List
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.contacts.filters') }}"
                                class="nav-link text-white {{ request()->routeIs('admin.contacts.filters') ? 'active' : '' }}">
                                <i class="fa-solid fa-filter"></i> Contact Filters
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Settings Section -->
                <li class="nav-item">
                    <a href="#" class="nav-link text-white" onclick="toggleSidebarSection('settings-section')">
                        <i class="fa-solid fa-gear"></i> Settings
                    </a>
                    <ul class="nav flex-column ms-3 d-none" id="settings-section">
                        <li>
                            <a href="{{ route('admin.users') }}"
                                class="nav-link text-white {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                                <i class="fa-solid fa-user-group"></i> User Data
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('mail.config') }}"
                                class="nav-link text-white {{ request()->routeIs('mail.config') ? 'active' : '' }}">
                                <i class="fa-solid fa-envelope"></i> Email Config
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.settings') }}"
                                class="nav-link text-white {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                                <i class="fa-solid fa-wrench"></i> General Settings
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <hr>
            <!-- Dropdown Profile Menu -->
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset(auth()->user()->photo ?? 'assets/images/default-profile.png') }}" alt="{{ auth()->user()->name }}" width="32"
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
<!-- Sidebar -->
