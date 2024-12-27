<div id="about-us"
    class="gh adjusted-scrolling w-75 mx-auto {{ Settings::getSettingValue('about')['status'] === 'on' ? '' : 'd-none' }}">
    <h2 class="fa fa-book">{{ translate('about')['section_title'] ?? 'About Us' }}</h2>
    <h1>{{ translate('about')['title'] ?? 'Who We Are' }}</h1>
    <p class="ppp">
        {{ translate('about')['description'] ?? 'Your description here' }}
    </p>
    <div class="gradient-line"></div>
</div>
