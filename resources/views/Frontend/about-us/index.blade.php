    <div id="about-us" class ="gh adjusted-scrolling w-75 mx-auto">
        <h2 class="fa fa-book">{{ $translations[app()->getLocale()]['section_title'] ?? 'About Us' }}</h2>
        <h1>{{ $translations[app()->getLocale()]['title'] ?? 'Who We Are' }}</h1>
        <p class="ppp">
            {{ $translations[app()->getLocale()]['description'] ?? 'Your description here' }}
        </p>
    </div>
