<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <img src="{{ asset('assets/images/Logo.png') }}" alt="Logo" class="navbar-brand ms-5" />
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse mt-3" id="navbarNav">
            <ul class="navbar-nav {{ $direction == 'ltr' ? 'me-5 ms-auto' : 'me-auto ms-5' }}">
                <li class=" nav-item na ">
                    <a class="nav-link fa fa-home" aria-current="page" href="#home">
                        {{ app()->getLocale() == 'ar' ? 'الرئيسية' : 'Home' }} </a>
                </li>
                <li class="nav-item na">
                    <a class="nav-link fa fa-book {{ Settings::getSettingValue('about')['status'] === 'on' ? '' : 'd-none' }}"
                        href="#about-us"> {{ app()->getLocale() == 'ar' ? 'من نحن' : 'About Us' }}</a>
                </li>
                <li class="nav-item na">
                    <a class="nav-link fa fa-bars {{ Settings::getSettingValue('projects')['status'] === 'on' ? '' : 'd-none' }}"
                        href="#projects"> {{ app()->getLocale() == 'ar' ? 'المشاريع' : 'Projects' }} </a>
                </li>
                <li class="nav-item na">
                    <a class="nav-link fa fa-star {{ Settings::getSettingValue('clients')['status'] === 'on' ? '' : 'd-none' }}"
                        href="#clients"> {{ app()->getLocale() == 'ar' ? 'العملاء' : 'Clients' }} </a>
                </li>
                <li class="nav-item na">
                    <a class="nav-link fa fa-users {{ Settings::getSettingValue('testimonials')['status'] === 'on' ? '' : 'd-none' }}"
                        href="#our-team"> {{ app()->getLocale() == 'ar' ? 'الفريق' : 'Team' }} </a>
                </li>
                <li class="nav-item na">
                    <a class="nav-link fa fa-gavel {{ Settings::getSettingValue('policy')['status'] === 'on' ? '' : 'd-none' }}"
                        href="#policies"> {{ app()->getLocale() == 'ar' ? 'السياسات' : 'Policies' }} </a>
                </li>
                <li class="nav-item na">
                    <a class="nav-link fa fa-phone {{ Settings::getSettingValue('contacts')['status'] === 'on' ? '' : 'd-none' }}"
                        href="#contact"> {{ app()->getLocale() == 'ar' ? 'اتصل بنا' : 'Contact' }}</a>
                </li>

                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Langauge
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
