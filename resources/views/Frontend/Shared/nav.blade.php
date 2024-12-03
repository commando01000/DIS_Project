<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <img src="{{ asset('assets/images/Logo.png') }}" alt="Logo" class="navbar-brand ms-5" />
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav {{ $direction == 'ltr' ? 'me-5 ms-auto' : 'me-auto ms-5' }}">
                <li class=" nav-item na ">
                    <a class="nav-link fa fa-home" aria-current="page" href="#home"> Home</a>
                </li>
                <li class="nav-item na">
                    <a class="nav-link fa fa-book" href="#about-us"> About</a>
                </li>
                <li class="nav-item na">
                    <a class="nav-link fa fa-bars" href="#projects"> Projects</a>
                </li>
                <li class="nav-item na">
                    <a class="nav-link fa fa-star" href="#clients"> Clients</a>
                </li>
                <li class="nav-item na">
                    <a class="nav-link fa fa-users" href="#our-team"> Team</a>
                </li>
                <li class="nav-item na">
                    <a class="nav-link fa fa-gavel" href="#policies"> Polices</a>
                </li>
                <li class="nav-item na">
                    <a class="nav-link fa fa-phone" href="#contact"> Contact</a>
                </li>

                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Lagauge
                    </button>
                    <ul class="dropdown-menu">
                        <li class="nav-item na nv">
                            <a class="nav-link" href="{{ route('lang', ['locale' => 'en']) }}">
                                <span>English</span>
                            </a>
                        </li>
                        <li class="nav-item na">
                            <a class="nav-link" href="{{ route('lang', ['locale' => 'ar']) }}">
                                <span>العربية</span>
                            </a>
                        </li>
                    </ul>
                </div>


            </ul>
        </div>
    </div>
</nav>
