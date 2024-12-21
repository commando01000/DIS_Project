    <!-- Sidebar -->
    <div name="sidebar" class="d-flex flex-column vh-100 flex-shrink-0 p-3 text-bg-dark position-fixed margin-10px" style="width: 280px;">

    {{-- <div class="d-flex flex-column vh-100 flex-shrink-0 p-3 text-bg-dark position-fixed" style="width: 280px;"> F --}}
        <a class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">

            <img style="bi pe-none me-2; background-color: white; border-radius: 20%; margin-right: 3px" width="40"
                height="32" src="{{ asset('assets/images/Logo.png') }}" alt="Logo" />

            <span class="fs-4"> Admin</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                    aria-current="page">
                    <i class="fa fab fa-home"></i>
                    Home
                </a>
            </li>
            <li>
                <a href="{{ route('admin.projects') }}"
                    class="nav-link text-white {{ request()->routeIs('admin.projects') ? 'active' : '' }}">
                    <i class="fa fab fa-kanban"></i>
                    Projects
                </a>
            </li>
            <li>
                <a href="{{ route('admin.client') }}"
                    class="nav-link text-white {{ request()->routeIs('admin.client') ? 'active' : '' }}">
                    <i class="fa fab fa-bank"></i>
                    Clients
                </a>
            </li>
            <li>
                <a href="{{ route('admin.testimonials') }}"
                    class="nav-link text-white {{ request()->routeIs('admin.testimonials') ? 'active' : '' }}">
                    <i class="fa fab fa-bank"></i>
                    Our Team
                </a>
            </li>
            <li>
                <a href="{{ route('admin.modules') }}"
                    class="nav-link text-white {{ request()->routeIs('admin.modules') ? 'active' : '' }}">
                    <i class="fa fab fa-table"></i>
                    Modules
                </a>
            </li>
            <li>
                <a href="{{ route('admin.about-us') }}"
                    class="nav-link text-white {{ request()->routeIs('admin.about-us') ? 'active' : '' }}">
                    <i class="fa fab fa-file-person"></i>
                    About us
                </a>
            </li>
            <li>
                <a href="{{ route('admin.contacts') }}"
                    class="nav-link text-white {{ request()->routeIs('admin.contact') ? 'active' : '' }}">
                    <i class="fa fab fa-person-rolodex"></i>
                    Contact Us
                </a>
            </li>
            <li>
                <a href="{{ route('admin.footer') }}"
                    class="nav-link text-white {{ request()->routeIs('admin.footer') ? 'active' : '' }}">
                    <i class="fa fab fa-footer "></i>
                    Footer
                </a>
            </li>

            {{-- <li>
                <a href="{{ route('admin.password') }}"
                    class="nav-link text-white {{ request()->routeIs('admin.password') ? 'active' : '' }}">
                    <svg class="bi pe-none me-2" width="16" height="16">
                        <use xlink:href="#people-circle" />
                    </svg>
                    Change Password
                </a>
            </li> --}}
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset(auth()->user()->photo) }}" alt="{{ auth()->user()->name }}" width="32"
                    height="32" class="rounded-circle me-2">
                <strong>{{ auth()->user()->name }}</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li>
                    <form method="GET" action="{{ route('admin.update-profile') }}">
                        @csrf
                        <!-- Button trigger modal -->
                        <button type="button" class="dropdown-item" data-bs-toggle="modal"
                            data-bs-target="#updateProfileModal">
                            Update Profile
                        </button>
                    </form>
                </li>
                <li>
                    <form method="GET" action="{{ route('admin.settings') }}">
                        @csrf
                        <!-- Button trigger modal -->
                        <a href="{{ route('admin.settings') }}" class="dropdown-item">Settings</a>
                    </form>
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
    <!-- Sidebar -->
