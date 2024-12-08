<div id="about-us"
    class="gh adjusted-scrolling w-75 mx-auto {{ Settings::getSettingValue('about-us')['status'] === 'on' ? '' : 'd-none' }}">
    <h2 class="fa fa-book">{{ translate('about-us')['section_title'] ?? 'About Us' }}</h2>
    <h1>{{ translate('about-us')['title'] ?? 'Who We Are' }}</h1>
    <p class="ppp">
        {{ translate('about-us')['description'] ?? 'Your description here' }}
    </p>
    <div class="gradient-line"></div>
</div>
