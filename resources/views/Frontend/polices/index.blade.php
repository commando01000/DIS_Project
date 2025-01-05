<div id="policies"
    class ="gh adjusted-scrolling w-75 mx-auto {{ Settings::getSettingValue('policy')['status'] === 'on' ? '' : 'd-none' }}">
    <h2 class="fa fa-gavel">{{Settings::getSettingValue('policy')[app()->getLocale()]['section_title'] ?? 'Policies' }}</h2>
    <h1>{{Settings::getSettingValue('policy')[app()->getLocale()]['name'] ?? 'Policies' }}</h1>
    <p class="ppp">
       {{Settings::getSettingValue('policy')[app()->getLocale()]['description'] ?? 'Your description here'}}
    </p>
    <div class="gradient-line"></div>
</div>
