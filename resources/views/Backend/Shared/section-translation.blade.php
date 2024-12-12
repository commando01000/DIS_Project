<!-- Section Translation Part -->
<div class="mb-4 row align-items-center">
    <div class="col-md-6 text-start">
        <label for="section_title_en" class="form-label">Section (EN)</label>
        <input type="text" class="form-control" name="section_title_en" id="section_title_en"
            value="{{ $settings['en']['section_title_en'] ?? '' }}" placeholder="Enter Section Name in English" />
        @error('section_title_en')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-6 text-end">
        <label for="section_title_ar" class="form-label">(AR) القسم</label>
        <input type="text" class="form-control" name="section_title_ar" id="section_title_ar"
            value="{{ $settings['ar']['section_title_ar'] ?? '' }}" placeholder="أدخل اسم القسم" dir="rtl" />
        @error('section_title_ar')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>


<!-- Title -->
<div class="mb-4 row align-items-center">
    <div class="col-md-6 text-start">
        <label for="title_en" class="form-label">Title (EN)</label>
        <input type="text" class="form-control" name="title_en" id="title_en"
            value="{{ $settings['en']['title_en'] ?? '' }}" placeholder="Enter Title in English" />
        @error('title_en')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-6 text-end">
        <label for="title_ar" class="form-label">(AR) العنوان</label>
        <input type="text" class="form-control" name="title_ar" id="title_ar"
            value="{{ $settings['ar']['title_ar'] ?? '' }}" placeholder="أدخل العنوان" dir="rtl" />
        @error('title_ar')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
