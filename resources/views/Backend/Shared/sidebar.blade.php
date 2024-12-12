    <!-- Sidebar -->
    <div class="d-flex flex-column vh-100 flex-shrink-0 p-3 text-bg-dark position-fixed" style="width: 280px;">
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
                    <svg class="bi pe-none me-2" width="16" height="16">
                        <use xlink:href="#home" />
                    </svg>
                    Home
                </a>
            </li>

            <li>
                <a href="{{ route('admin.projects') }}"
                    class="nav-link text-white {{ request()->routeIs('admin.projects') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-kanban-fill" viewBox="0 0 16 16">
                        <path
                            d="M2.5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm5 2h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1m-5 1a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1zm9-1h1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1" />
                    </svg>
                    Projects
                </a>
            </li>
            <li>
                <a href="{{ route('admin.client') }}"
                    class="nav-link text-white {{ request()->routeIs('admin.client') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-bank2" viewBox="0 0 16 16">
                        <path
                            d="M8.277.084a.5.5 0 0 0-.554 0l-7.5 5A.5.5 0 0 0 .5 6h1.875v7H1.5a.5.5 0 0 0 0 1h13a.5.5 0 1 0 0-1h-.875V6H15.5a.5.5 0 0 0 .277-.916zM12.375 6v7h-1.25V6zm-2.5 0v7h-1.25V6zm-2.5 0v7h-1.25V6zm-2.5 0v7h-1.25V6zM8 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2M.5 15a.5.5 0 0 0 0 1h15a.5.5 0 1 0 0-1z" />
                    </svg>
                    Clients
                </a>
            </li>
            <li>
                <a href="{{ route('admin.testimonials') }}"
                    class="nav-link text-white {{ request()->routeIs('admin.testimonials') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-bank2" viewBox="0 0 16 16">
                        <path
                            d="M8.277.084a.5.5 0 0 0-.554 0l-7.5 5A.5.5 0 0 0 .5 6h1.875v7H1.5a.5.5 0 0 0 0 1h13a.5.5 0 1 0 0-1h-.875V6H15.5a.5.5 0 0 0 .277-.916zM12.375 6v7h-1.25V6zm-2.5 0v7h-1.25V6zm-2.5 0v7h-1.25V6zm-2.5 0v7h-1.25V6zM8 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2M.5 15a.5.5 0 0 0 0 1h15a.5.5 0 1 0 0-1z" />
                    </svg>
                    Our Team
                </a>
            </li>
            <li>
                <a href="{{ route('admin.modules') }}"
                    class="nav-link text-white {{ request()->routeIs('admin.modules') ? 'active' : '' }}">
                    <svg class="bi pe-none me-2" width="16" height="16">
                        <use xlink:href="#table" />
                    </svg>
                    Modules
                </a>
            </li>
            <li>
                <a href="{{ route('admin.about-us') }}"
                    class="nav-link text-white {{ request()->routeIs('admin.about-us') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-file-person" viewBox="0 0 16 16">
                        <path
                            d="M12 1a1 1 0 0 1 1 1v10.755S12 11 8 11s-5 1.755-5 1.755V2a1 1 0 0 1 1-1zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                        <path d="M8 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                    </svg>
                    About us
                </a>
            </li>
            <li>
                <a href="{{ route('admin.password') }}"
                    class="nav-link text-white {{ request()->routeIs('admin.password') ? 'active' : '' }}">
                    <svg class="bi pe-none me-2" width="16" height="16">
                        <use xlink:href="#people-circle" />
                    </svg>
                    Change Password
                </a>
            </li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/mdo.png" alt="" width="32" height="32"
                    class="rounded-circle me-2">
                <strong>{{ auth()->user()->name }}</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                {{-- <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li> --}}
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
