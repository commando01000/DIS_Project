<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(Request $request, Settings $settings)
    {
        $settings = Settings::all()->except('total_visits');
        // Fetch current .env email settings


        logger('Route Name:', [$request->route()->getName()]);
        return view('Backend.Settings.index', compact('settings'));
    }

    public function email_store(Request $request) {}

    protected function storeSettings(Request $request, string $key, array $validationRules, string $status, array $locales = ['en', 'ar'])
    {
        $request->validate($validationRules);

        $value = $this->prepareValue($request, $key, $status, $locales);

        Settings::updateOrCreate(
            ['key' => $key],
            ['value' => json_encode($value)]
        );

        $successMessage = ucfirst($key) . ' updated successfully';
        return redirect()->back()->with('success', $successMessage);
    }


    protected function prepareValue(Request $request, string $key, string $status, array $locales)
    {
        $value = [];

        switch ($key) {
            case 'swiper':
                // Retrieve the existing record
                $existingSetting = Settings::where('key', $key)->first();
                $existingSwiperData = [];

                if ($existingSetting) {
                    $existingValue = json_decode($existingSetting->value, true);
                    $existingSwiperData = $existingValue['swiper-data'] ?? [];
                }

                // Handle new swiper-data input
                $newSwiperData = [];

                if ($request->has('swiper-data')) {
                    $swiperData = $request->input('swiper-data');

                    // Iterate through each input row
                    foreach ($swiperData as $index => $data) {
                        if (
                            isset($data['title_en'], $data['description_en'], $data['title_ar'], $data['description_ar']) &&
                            !empty($data['title_en']) && !empty($data['description_en']) &&
                            !empty($data['title_ar']) && !empty($data['description_ar'])
                        ) {
                            // Check if the index exists in existing data
                            if (isset($existingSwiperData[$index])) {
                                // Update the existing entry
                                $existingSwiperData[$index] = [

                                    'en' => [
                                        'title' => $data['title_en'],
                                        'description' => $data['description_en'],
                                    ],
                                    'ar' => [
                                        'title' => $data['title_ar'],
                                        'description' => $data['description_ar'],
                                    ],
                                ];
                            } else {
                                // Add as a new entry
                                $newEntry = [

                                    'en' => [
                                        'title' => $data['title_en'],
                                        'description' => $data['description_en'],
                                    ],
                                    'ar' => [
                                        'title' => $data['title_ar'],
                                        'description' => $data['description_ar'],
                                    ],
                                ];
                                $newSwiperData[] = $newEntry;
                            }
                        }
                    }
                }
                // dd('prepareValue');
                // Merge updated entries with existing ones
                $mergedSwiperData = array_merge($existingSwiperData, $newSwiperData);

                // Assign the merged data back
                $value['swiper-data'] = $mergedSwiperData;
                $value['status'] = $status ?? 'on';
                break;

            case 'footer':
                foreach ($locales as $locale) {
                    $value[$locale] = [
                        "name" => $request->input("name_{$locale}"),
                        "description" => $request->input("description_{$locale}")
                    ];
                }
                $value['social_media'] = $request->input('social_media');
                $value['status'] = $status ?? 'on';
                break;

            case 'policy':
                foreach ($locales as $locale) {
                    $value[$locale] = [
                        "name" => $request->input("title_{$locale}"),
                        "section_title" => $request->input("section_title_{$locale}")
                    ];
                }
                $value['status'] = $status ?? 'on';
                break;

            case 'projects': // Add handling for projects
                foreach ($locales as $locale) {
                    $value[$locale] = [
                        "title" => $request->input("title_{$locale}"),
                        "section_title" => $request->input("section_title_{$locale}")
                    ];
                }
                $value['status'] = $status ?? 'on';
                $value['project_list'] = $request->input('projects', []); // Store additional project data if provided
                break;

            case 'side-button':
                $value = ['url' => $request->url, 'status' => $status ?? 'on'];
                break;

            case 'contacts':
                foreach ($locales as $locale) {
                    $value[$locale] = [
                        "title" => $request->input("title_{$locale}"),
                        "section_title" => $request->input("section_title_{$locale}"),
                        'nationality_title' => $request->input("nationality_title_{$locale}"),
                        'category_title' => $request->input("category_title_{$locale}"),
                        'our_phone_title' => $request->input("our_phone_title_{$locale}"),
                        'client_phone_title' => $request->input("client_phone_title_{$locale}"),
                        'email_title' => $request->input("email_title_{$locale}")
                
                    ];
                }
                $value['contact-info'] = [
                    'phone' => $request->phone ?? "",
                    'email' => $request->email ?? "",
                    'address' => $request->address ?? "",
                ];
                $value['status'] = $status ?? 'on';
                break;

            case 'testimonials':
                foreach ($locales as $locale) {
                    $value[$locale] = [
                        "title" => $request->input("title_{$locale}"),
                        "section_title" => $request->input("section_title_{$locale}")
                    ];
                }
                $value['status'] = $status ?? 'on';
                break;
            case 'clients':

                foreach ($locales as $locale) {
                    $value[$locale] = [
                        "title" => $request->input("title_{$locale}"),
                        "section_title" => $request->input("section_title_{$locale}")
                    ];
                }
                $value['status'] = $status ?? 'on';
                break;
            case 'contacts_filters':

                // Fetch the existing settings and filter data
                $existingSetting = Settings::where('key', $key)->first();
                $existingFilter_data = [];

                if ($existingSetting) {
                    $existingValue = json_decode($existingSetting->value, true);
                    $existingFilter_data = $existingValue['filter-data'] ?? [];
                }

                // Initialize an array for new filter data
                $newFilter_data = [];

                if ($request->has('filter-data')) {
                    $filter_data = $request->input('filter-data');

                    // Iterate through each input row from the request
                    foreach ($filter_data as $index => $data) {
                        if (isset($data['filter_en'], $data['filter_ar'])) {
                            $filter_exists = false;

                            // Check if the filter already exists by comparing the 'filter_en'
                            foreach ($existingFilter_data as $existingIndex => $existingData) {
                                if (isset($existingData['en']['filter']) && $existingData['en']['filter'] === $data['filter_en']) {
                                    // If the filter already exists, update it
                                    $existingFilter_data[$existingIndex] = [
                                        'en' => ['filter' => $data['filter_en']],
                                        'ar' => ['filter' => $data['filter_ar']],
                                    ];
                                    $filter_exists = true;
                                    break;
                                }
                            }

                            // If the filter does not exist, add it as a new entry
                            if (!$filter_exists) {
                                $newFilter_data[] = [
                                    'en' => ['filter' => $data['filter_en']],
                                    'ar' => ['filter' => $data['filter_ar']],
                                ];
                            }
                        }
                    }
                }

                // Merge existing and new filter data
                $mergedFilter_data = array_merge($existingFilter_data, $newFilter_data);
                $value['filter-data'] = $mergedFilter_data;

                break;
        }
        return $value;
    }
    public function footer_store(Request $request)
    {

        $status = $request->status ?? 'on';
        return $this->storeSettings($request, 'footer', [
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'description_en' => 'required|string|max:255',
            'description_ar' => 'required|string|max:255',
            'social_media' => 'nullable|array',
            'social_media.*.key' => 'nullable|string|max:255',
            'social_media.*.value' => 'nullable',
        ], status: $status);
    }
    public function clients(Request $request)
    {

        $status = $request->status ?? 'on';
        return $this->storeSettings($request, 'clients', [
            'section_title_en' => 'required|string|max:255',
            'section_title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',

        ], status: $status);
    }
    public function swiper(Request $request)
    {
        $status = $request->status ?? 'on';

        // Process social media links
        // $socialMediaLinks = $this->processSocialMedia($request, 'content');

        // Merge social media links into swiper value
        // $request->merge(['social_media_links' => $socialMediaLinks]);
        // [
        //     'swiper-data' => 'nullable|array',
        //     'swiper-data.*.key' => 'nullable|string|max:255',
        //     'swiper-data.*.value' => 'nullable|string',
        // ]
        // dd('swiper');
        return $this->storeSettings($request, 'swiper', [], status: $status);
    }


    public function updateSwiperData(Request $request)
    {
        // dd('updateSwiperData');
        // Get the index and other inputs
        $index = $request->input('index');
        // dd($index);
        $titleEn = $request->input('title_en');
        $descriptionEn = $request->input('description_en');
        $titleAr = $request->input('title_ar');
        $descriptionAr = $request->input('description_ar');

        // Fetch the setting
        $setting = Settings::where('key', 'swiper')->first();

        if (!$setting) {
            return redirect()->route('admin.swiper', ['index' => $index])->with(['error' => 'Setting not found'], 404);
        }

        // Decode the JSON data
        $data = json_decode($setting->value, true);

        // Check if the index exists
        if (isset($data['swiper-data'][$index])) {
            // Update the swiper data
            $data['swiper-data'][$index]['en']['title'] = $titleEn;
            $data['swiper-data'][$index]['en']['description'] = $descriptionEn;
            $data['swiper-data'][$index]['ar']['title'] = $titleAr;
            $data['swiper-data'][$index]['ar']['description'] = $descriptionAr;
        } else {
            return redirect()->route('admin.swiper')->with(['error' => 'Item not found'], 404);
        }

        // Save the updated data back to the database
        $setting->value = json_encode($data);
        $setting->save();

        return redirect()->route('admin.swiper')->with(['message' => 'Swiper data updated successfully']);
    }



    public function police_store(Request $request)
    {
        $status = $request->status ?? 'off';
        return $this->storeSettings($request, 'policy', [
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'section_title_ar' => 'required|string|max:255',
            'section_title_en' => 'required|string|max:255',
        ], status: $status);
    }

    public function side_button_store(Request $request)
    {
        $status = $request->status ?? 'on';
        return $this->storeSettings($request, 'side-button', [
            'url' => 'required|url|min:3|max:255',
        ], status: $status);
    }

    public function contacts_store(Request $request)
    {
        // dd(request()->all());
        $status = $request->status ?? 'on';

        return $this->storeSettings($request, 'contacts', [
            'section_title_en' => 'required|string|max:255',
            'section_title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'category_title_en' => 'required|string|max:255',
            'category_title_ar' => 'required|string|max:255',
            'our_phone_title_en' => 'required|string|max:255',
            'client_phone_title_ar' => 'required|string|max:255',
            'nationality_title_en' => 'required|string|max:255',
            'nationality_title_ar' => 'required|string|max:255',
            'email_title_en' => 'required|string|max:255',
            'email_title_ar' => 'required|string|max:255',
            'contact-info' => [
                'phone' => $validatedData['phone'] ?? null,
                'email' => $validatedData['email'] ?? null,
                'address' => $validatedData['address'] ?? null,
            ],
            'filter-data' => 'nullable|array',
            'filter-data.*.key' => 'nullable|string|max:255',
            'filter-data.*.value' => 'nullable',
        ], status: $status);
    }
    public function contacts_filters_store(Request $request)
    {
        // dd(request()->all());
        $status = $request->status ?? 'on';

        return $this->storeSettings($request, 'contacts_filters', [
            'filter-data' => 'nullable|array',
            'filter-data.*.key' => 'nullable|string|max:255',
            'filter-data.*.value' => 'nullable',
        ], status: $status);
    }
    protected function processSocialMedia(Request $request, $key)
    {
        $socialMedia = [];
        if ($request->has($key)) {
            foreach ($request->input($key) as $link) {
                if (!empty($link['key']) && !empty($link['value'])) {
                    $socialMedia[] = [$link['key'] => $link['value']];
                }
            }
        }

        return $socialMedia;
    }


    public function projectSettingsStore(Request $request)
    {
        $status = $request->status ?? 'on';
        return $this->storeSettings($request, 'projects', [
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'section_title_en' => 'required|string|max:255',
            'section_title_ar' => 'required|string|max:255',
            'projects' => 'nullable|array',
        ], $status);
    }
    public function update_project_translation(Request $request)

    {
        $status = $request->status ?? 'on';
        return $this->storeSettings($request, 'testimonials', [
            'section_title_en' => 'required|string|min:3|max:255',
            'section_title_ar' => 'required|string|min:3|max:255',
            'title_en' => 'required|string|min:3|max:255',
            'title_ar' => 'required|string|min:3|max:255',
            'status' => 'nullable|string',
        ], $status);
    }
}
