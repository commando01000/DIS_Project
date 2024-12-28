@extends('Backend.Shared.layout')
@section('content')
    <div id="logo-img"
        class="w-75 text-center vh-100 d-flex align-items-center mt-5 justify-content-center animate__animated animate__lightSpeedInRight">
        <img style="background-color: white; border-radius: 20%; width: 30%; hight: 30%;"
            src="{{ asset('assets/images/Logo.png') }}" alt="Logo" />
    </div>

    <form>
        <textarea class="ckeditorform-control" name="editor1" id="editor1" rows="10" cols="60">
        </textarea>
    </form>
@endsection
