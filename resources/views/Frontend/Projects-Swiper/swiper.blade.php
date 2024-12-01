<!-- Swiper -->
<style>
    swiper-slide img {
        width: 100%;
        height: auto;
        object-fit: cover;
        border-radius: 8px;
    }
</style>

<br>
<swiper-container class="mySwiper animate__animated animate__backInLeft " pagination="true" pagination-clickable="true"
    navigation="true" space-between="30" centered-slides="true" autoplay-delay="2500"
    autoplay-disable-on-interaction="false">
    <swiper-slide><img src="{{ asset('assets/images/d4.png') }}" alt="d4" loading="lazy" /></swiper-slide>
    <swiper-slide><img src="{{ asset('assets/images/d4.png') }}" alt="d4" loading="lazy" /></swiper-slide>
    <swiper-slide><img src="{{ asset('assets/images/d4.png') }}" alt="d4" loading="lazy" /></swiper-slide>
    <swiper-slide><img src="{{ asset('assets/images/d4.png') }}" alt="d4" loading="lazy" /></swiper-slide>

    <div class="autoplay-progress" slot="container-end">
        <svg viewBox="0 0 48 48">
            <circle cx="24" cy="24" r="20"></circle>
        </svg>
        <span></span>
    </div>

</swiper-container>
