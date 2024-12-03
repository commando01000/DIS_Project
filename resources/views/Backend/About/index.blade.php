@extends('Backend.Shared.layout')

@section('title', 'About')
@section('css')
    <style>
        .input-group-text {
            width: 100px;
        }
    </style>
@endsection

@section('content')
    <div id="about-us-back" class="m-5 p-5 w-75 mx-auto">
        <form action="{{ route('admin.about-us.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Section Title EN</label>
                <input type="text" class="form-control" name="section_title_en" id="section-title-en"
                    placeholder="Section Title en" value="{{ $translations['en']['section_title'] ?? '' }}" />
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Section Title AR</label>
                <input type="text" class="form-control" name="section_title_ar" id="section-title-ar"
                    placeholder="Section Title ar" value="{{ $translations['ar']['section_title'] ?? '' }}" />
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Title EN</label>
                <input type="text" class="form-control" name="title_en" id="title-en" placeholder="Title en"
                    value="{{ $translations['en']['title'] ?? '' }}" />
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Title AR</label>
                <input type="text" class="form-control" name="title_ar" id="title-ar" placeholder="Title ar"
                    value="{{ $translations['ar']['title'] ?? '' }}" />
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Description EN</label>
                <input type="text" class="form-control" name="description_en" id="description-en"
                    placeholder="Description en" value="{{ $translations['en']['description'] ?? '' }}" />
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Description AR</label>
                <input type="text" class="form-control" name="description_ar" id="description-ar"
                    placeholder="Description ar" value="{{ $translations['ar']['description'] ?? '' }}" />
            </div>

            <input class="btn btn-success" type="submit" />
        </form>
    </div>
@endsection
