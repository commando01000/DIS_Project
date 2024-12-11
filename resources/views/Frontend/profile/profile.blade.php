@extends('layouts.frontend')

@section('content')
<div class="profile">
    <h1>{{ $profile['name'] }}</h1>
    <p><strong>Role:</strong> {{ $profile['role'] }}</p>
    <p><strong>Description:</strong> {{ $profile['description'] }}</p>
    <p><strong>Address:</strong> {{ $profile['address'] }}</p>

    @if($profile['image'])
        <img src="{{ asset($profile['image']) }}" alt="{{ $profile['name'] }}">
    @endif

    @if(!empty($profile['social_media']))
        <h3>Social Media Links</h3>
        <ul>
            @foreach($profile['social_media'] as $key => $value)
                <li><a href="{{ $value }}" target="_blank">{{ ucfirst($key) }}</a></li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
