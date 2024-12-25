<div>


    <h2>Footer</h2>
    <form action="{{ route('update.settings.footer') }}" method="POST">
        @csrf
        <div class="mb-4 row align-items-center">
            <div class="col-md-6 text-start">
                <label for="name_en" class="form-label">Company Name (EN)</label>
                <input type="text" class="form-control" placeholder="Enter Company Name in English" name="name_en"
                    id="name_en" value="{{ Settings::getSettingValue('footer')['en']['name'] ?? '' }}" />
                @error('name_en')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 text-end">
                <label for="name_ar" class="form-label">(AR) اسم الشركه </label>
                <input type="text" class="form-control" name="name_ar" id="name_ar"
                    value="{{ Settings::getSettingValue('footer')['ar']['name'] ?? '' }}"
                    placeholder="اسم الشركه العربيه" dir="rtl" />
                @error('name_ar')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3 row align-items-center">
            <div class="col-md-6 text-start">
                <label for="description_en" class="form-label">description (EN)</label>
                <textarea class="form-control" placeholder="description for company" name="description_en" id="description_en">{{ Settings::getSettingValue('footer')['en']['description'] ?? '' }}</textarea>
                @error('description_en')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 text-end">
                <label for="description_ar" class="form-label">(AR) وصف لي الشركه</label>
                <textarea class="form-control" name="description_ar" id="description_ar" placeholder="وصف لي الشركه" dir="rtl">{{ Settings::getSettingValue('footer')['ar']['description'] ?? '' }}</textarea>
                @error('description_ar')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>



        @include('Backend.Shared.form-actions', ['settings' => Settings::getSettingValue('footer'), 'formName'=>'footer'])
    </form>
</div>
