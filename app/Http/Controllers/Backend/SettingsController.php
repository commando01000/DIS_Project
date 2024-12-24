<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(Settings $settings)
    {
        $settingsKeys = ['address', 'social-media', 'phone', 'email', 'top-slider', 'footer', 'policy', 'side-button'];

        foreach ($settingsKeys as $key) {
            $settings[$key] = settings::firstOrCreate(
                ['key' => $key],
                ['value' => json_encode('N/A')]
            );
        }

        foreach ($settings as $key => $value) {
            $settings[$key] = json_decode($value, true);
        }

        return view('Backend.Settings.index', compact('settings'));
    }

    protected function storeSettings(Request $request, string $key, array $validationRules, array $locales = ['en', 'ar'])
    {
        $request->validate($validationRules);

        $settings = settings::firstOrCreate(
            ['key' => $key],
            ['value' => json_encode(['status' => 'on'])]
        );

        $value = $this->prepareValue($request, $key, $locales);

        settings::updateOrCreate(
            ['key' => $key],
            ['value' => json_encode($value)]
        );

        $successMessage = ucfirst($key) . ' ' . (settings::where('key', $key)->exists() ? 'updated' : 'created') . ' successfully';
        return redirect()->back()->with('success', $successMessage);
    }

    protected function prepareValue(Request $request, string $key, array $locales)
    {
        $value = [];

        switch ($key) {
            case 'top-slider':
                foreach ($locales as $locale) {
                    $value[$locale] = [
                        "title" => $request->input("title_{$locale}"),
                        "description" => $request->input("description_{$locale}")
                    ];
                }
                $value['status'] = $request->status;
                break;

            case 'footer':
                foreach ($locales as $locale) {
                    $value[$locale] = [
                        "name" => $request->input("name_{$locale}"),
                        "description" => $request->input("description_{$locale}")
                    ];
                }
                $value['links'] = $this->processSocialMedia($request);
                $value['status'] = $request->status;
                break;

            case 'policy':
                foreach ($locales as $locale) {
                    $value[$locale] = [
                        "name" => $request->input("title_{$locale}"),
                        "section_title" => $request->input("section_title_{$locale}")
                    ];
                }
                break;

            case 'side-button':
                $value = ['url' => $request->url];
                break;
        }

        return $value;
    }

    protected function processSocialMedia(Request $request)
    {
        $socialMedia = [];
        if ($request->has('social_media')) {
            foreach ($request->input('social_media') as $link) {
                if (!empty($link['key']) && !empty($link['value'])) {
                    $socialMedia[] = [$link['key'] => $link['value']];
                }
            }
        }
        return $socialMedia;
    }

    public function slider(Request $request)
    {
        return $this->storeSettings($request, 'top-slider', [
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string|max:255',
            'description_ar' => 'required|string|max:255',
        ]);
    }

    public function footer_store(Request $request)
    {
        return $this->storeSettings($request, 'footer', [
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'description_en' => 'required|string|max:255',
            'description_ar' => 'required|string|max:255',
            'social_media' => 'nullable|array',
            'social_media.*.key' => 'nullable|string|max:255',
            'social_media.*.value' => 'nullable',
        ]);
    }

    public function police_store(Request $request)
    {
        return $this->storeSettings($request, 'policy', [
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'section_title_ar' => 'required|string|max:255',
            'section_title_en' => 'required|string|max:255',
        ]);
    }

    public function side_button_store(Request $request)
    {
        return $this->storeSettings($request, 'side-button', [
            'url' => 'required|url|min:3|max:255',
        ], []);
    }
}
