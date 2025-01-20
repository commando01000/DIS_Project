<div id="about-us"
    class="gh adjusted-scrolling w-75 mx-auto {{ Settings::getSettingValue('about')['status'] === 'on' ? '' : 'd-none' }}">
    <h2 class="fa fa-book">{{ translate('about')['section_title'] ?? 'About Us' }}</h2>
    <h1>{{ translate('about')['title'] ?? 'Who We Are' }}</h1>
    <p class="ppp">
        {{ translate('about')['description'] ?? 'Your description here' }}
    </p>
    <div id="total-visits-count"class="text-end ppp pb-5">
        Total Visits Count : {{ Settings::getSettingValue('total_visits') ?? '0' }}
    </div>
    <div class="gradient-line"></div>
</div>
