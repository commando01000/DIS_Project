<nav class="navbar navbar-expand-lg bg-body-tertiary animate__animated animate__fadeInDown">
    <div class="container-fluid">
        <img src="{{ asset('assets/images/Logo.png') }}" alt="Logo" class="navbar-brand ms-5" />
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-5 ms-auto">
                <li class=" nav-item na ">
                    <a class="nav-link fa fa-home  {{Route::is('home') ? 'active' : ''}}" aria-current="page" href="{{ route('home') }}"> Home</a>
                </li>
                <li class="nav-item na">
                    <a class="nav-link fa fa-bars {{Route::is('projects') ? 'active' : ''}}" href="{{ route('projects') }}"> Projects</a>
                </li>
                <li class="nav-item na">
                    <a class="nav-link fa fa-users {{Route::is('engineers') ? 'active' : ''}}" href="{{ route('engineers') }}"> Engineers</a>
                </li>
                <li class="nav-item na">
                    <a class="nav-link fa fa-book {{Route::is('about-us') ? 'active' : ''}}" href="{{ route('about-us') }}"> About Us</a>
                </li>
                <li class="nav-item na">
                    <a class="nav-link fa fa-phone {{Route::is('contact-us') ? 'active' : ''}}" href="{{ route('contact-us') }}"> Contact Us</a>
                </li>

                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Lagauge
                    </button>
                    <ul class="dropdown-menu">
                        <li class="nav-item na">
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

