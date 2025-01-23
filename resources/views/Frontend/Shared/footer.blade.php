<footer class="text-center text-lg-start bg-body-tertiary text-muted fo ">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
        <!-- Left -->
        <div class="me-5 d-none d-lg-block">
        </div>
        <!-- Left -->

        <!-- Right -->

        {{-- Social Media --}}
        <div>
            @foreach ($footer['social_media'] ?? [] as $key => $social_media)
                <a href="{{ $social_media['value'] }}" target="_blank" class="me-4 text-reset">
                    <i class="fa fab fa-{{ $social_media['key'] }}"></i>
                </a>
            @endforeach
        </div>
        <!-- Right -->
    </section>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="">
        {{-- {{dd();}} --}}
        <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <!-- Content -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        <i class="fa fas fa-gem me-3"></i>{{ $footer[app()->getLocale()]['name'] ?? '' }}
                    </h6>
                    <p>
                        {{ $footer[app()->getLocale()]['description'] ?? '' }}
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                {{-- <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        Products
                    </h6>
                    <p>
                        <a href="#!" class="text-reset">Angular</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">React</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Vue</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Laravel</a>
                    </p>
                </div> --}}
                <!-- Grid column -->

                <!-- Grid column -->
                {{-- <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        Useful links
                    </h6>
                    <p>
                        <a href="#about-us"
                            class="text-reset {{ Settings::getSettingValue('about')['status'] === 'on' ? '' : 'd-none' }}">About</a>
                    </p>
                    <p>
                        <a href="#projects"
                            class="text-reset {{ Settings::getSettingValue('projects')['status'] === 'on' ? '' : 'd-none' }}">Projects</a>
                    </p>
                    <p>
                        <a href="#clients"
                            class="text-reset {{ Settings::getSettingValue('clients')['status'] === 'on' ? '' : 'd-none' }}">Clients</a>
                    </p>
                    <p>
                        <a href="#our-team"
                            class="text-reset {{ Settings::getSettingValue('testimonials')['status'] === 'on' ? '' : 'd-none' }}">Team</a>
                    </p>
                    <p>
                        <a href="#policies"
                            class="text-reset {{ Settings::getSettingValue('policy')['status'] === 'on' ? '' : 'd-none' }}">Policy</a>
                    </p>
                    <p>
                        <a href="#contact"
                            class="text-reset {{ Settings::getSettingValue('contacts')['status'] === 'on' ? '' : 'd-none' }}">Contact</a>
                    </p>
                </div> --}}
                <!-- Grid column -->

                <!-- Grid column -->
                {{-- <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                    @foreach (Settings::getSettingValue('contacts')['contact-info'] ?? [] as $key => $value)
                        <p><i class="fa fas fa-{{ $key }} me-3"></i> {{ $value }}</p>
                    @endforeach
                    
                    <p>
                        <i class="fa fas fa-envelope me-3"></i>
                        info@example.com
                    </p>
                    <p><i class=" fa fas fa-phone me-3"></i> + 01 234 567 88</p>
                    <p><i class="fa fas fa-print me-3"></i> + 01 234 567 89</p>
                </div> --}}
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->

    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
        <div id="total-visits-count" class="text-center">
            Total Visits Count : {{ Settings::getSettingValue('total_visits') ?? '0' }}
        </div>

        <div>
            © {{ date('Y') }} Copyright:
            <a class="text-reset fw-bold" href="https://mdbootstrap.com/">DIS</a>
        </div>

    </div>
    <!-- Copyright -->

</footer>
