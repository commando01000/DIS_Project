<footer class="text-center text-lg-start bg-body-tertiary text-muted fo ">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
        <!-- Left -->
        <div class="me-5 d-none d-lg-block">
            <span class="fos">Get connected with us on social networks:</span>
        </div>

        <!-- Right -->
        {{-- <div>
            @foreach (Settings::getSettingValue('footer')['links'] as $link)
                @php
                    // Extract key and value from the dictionary
                    $key = array_key_first($link) ?? null; // Get the key (e.g., "github")
                    $value = $link[$key] ?? null; // Get the value (e.g., "https://github.com")
                @endphp
                <a href="{{ $value }}" class="me-4 text-reset">
                    <i class="fa fab fa-{{$key}}"></i> <!-- Use the key for the icon -->
                </a>
            @endforeach
        </div> --}}
        <!-- Right -->
    </section>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="">
        <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <!-- Content -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        {{-- <i class="fa fas fa-gem me-3"></i>{{Settings::getSettingValue('footer')[app()->getLocale(['name'])] ?? 'Footer' }} --}}
                    </h6>
                    <p>

                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
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
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4  ulinks">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        Useful links
                    </h6>
                    <p>
                        <a href="#projects" class="text-reset">Projects</a>
                    </p>
                    <p>
                        <a href="#clients" class="text-reset">Clients</a>
                    </p>
                    <p>
                        <a href="#our-team" class="text-reset">Team</a>
                    </p>
                    <p>
                        <a href="#policies" class="text-reset">Policies</a>
                    </p>
                    <p>
                        <a href="#contact" class="text-reset">Contact us</a>
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                    <p><i class="fa fas fa-home me-3"></i> New York, NY 10012, US</p>
                    <p>
                        <i class="fa fas fa-envelope me-3"></i>
                        info@example.com
                    </p>
                    <p><i class=" fa fas fa-phone me-3"></i> + 01 234 567 88</p>
                    <p><i class="fa fas fa-print me-3"></i> + 01 234 567 89</p>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
        © 2021 Copyright:
        <a class="text-reset fw-bold" href="https://mdbootstrap.com/">DIS.com</a>
    </div>
    <!-- Copyright -->
</footer>
