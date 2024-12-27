<div class="cardss justify-content-center d-flex flex-wrap gap-5 mt-5">
    @foreach ($testimonials as $member)
        <div class="card position-relative">
            {{-- Display the image --}}
            <div class="profile-pic">
                <img src="{{ asset($member->image) ?? '' }}"
                    alt="{{ $member->name[app()->getLocale()] ?? 'Image description not available' }}">
            </div>
            <div class=" bottom row align-items-center mx-0">
                <div class="mt-5 col ">
                    {{-- Display the role --}}
                    <p class="dd">{{ $member->role[app()->getLocale()] ?? 'Role not provided' }}</p>

                    {{-- Display the name --}}
                    <h3 class="dd">{{ $member->name[app()->getLocale()] ?? 'Name not provided' }}</h3>
                </div>
                <div class="mt-5 col ">
                    {{-- QR Code link --}}
                    <a class="qr-code" href="{{ route('profile', ['id' => $member->id]) }}"
                        data-url="{{ route('profile', ['id' => $member->id]) }}">
                        View Profile
                    </a>
                </div>
                <div class="bottom-bottom">
                    <button onclick="window.location.href='{{ route('profile', ['id' => $member->id]) }}'"
                        class="button">Profile</button>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="pagination-links" data-section="testimonials">
    {{ $testimonials->links() }}
</div>
