<div class="cardss justify-content-center d-flex flex-wrap gap-5 mt-5">
    @foreach ($testimonials as $testimonial)
        <div class="card">
            <div class="profile-pic">
                <img src="{{ asset($testimonial->image) }}" alt="profile pic" loading="lazy" />
            </div>
            <div class="bottom">
                <div class="content">
                    <span class="name">{{ $testimonial->name[app()->getLocale()] ?? 'name here' }}</span>
                    <span class="about-me">
                        {{ $testimonial->role[app()->getLocale()] ?? 'role here' }}
                    </span>
                </div>
                <div class="bottom-bottom">
                    <button class="button">Contact Me</button>

                    <button class="button">Profile</button>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="pagination-links" data-section="testimonials">
    {{ $testimonials->links() }}
</div>
