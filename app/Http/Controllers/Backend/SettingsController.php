<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(Settings $settings)
    {
        $settingsKeys_with_status = [
            'top-slider',
            'footer',
            'policy',
            'side-button',
            'projects', // Add projects settings here
            'testimonials',
            'top-slider'
        ];
        foreach ($settingsKeys_with_status as $key) {
            $settings[$key] = Settings::firstOrCreate(
                ['key' => $key],
                ['value' => json_encode(['status' => 'on'])]
            );
        }
        $settingsKeys = [
            'address',
            'social-media',
            'phone',
            'email',
        ];
        foreach ($settingsKeys as $key) {
            $settings[$key] = Settings::firstOrCreate(
                ['key' => $key],
                ['value' => json_encode('N/A')]
            );
        }

        foreach ($settings as $key => $value) {
            $settings[$key] = json_decode($value, true);
        }

        return view('Backend.Settings.index', compact('settings'));
    }

    protected function storeSettings(Request $request, string $key, array $validationRules, string $status, array $locales = ['en', 'ar'])
    {
        $request->validate($validationRules);

        $settings = settings::firstOrCreate(
            ['key' => $key],
            ['value' => json_encode(['status' => 'on'])]
        );

        $value = $this->prepareValue($request, $key, $status, $locales);

        settings::updateOrCreate(
            ['key' => $key],
            ['value' => json_encode($value)]
        );

        $successMessage = ucfirst($key) . ' ' . (settings::where('key', $key)->exists() ? 'updated' : 'created') . ' successfully';
        return redirect()->back()->with('success', $successMessage);
    }

    protected function prepareValue(Request $request, string $key, string $status, array $locales)
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
                $value['status'] = $status ?? 'on';
                break;

            case 'footer':
                foreach ($locales as $locale) {
                    $value[$locale] = [
                        "name" => $request->input("name_{$locale}"),
                        "description" => $request->input("description_{$locale}")
                    ];
                }
                $value['links'] = $this->processSocialMedia($request);
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
                $value = ['url' => $request->url];
                break;

            case 'contacts':
                foreach ($locales as $locale) {
                    $value[$locale] = [
                        "title" => $request->input("title_{$locale}"),
                        "section_title" => $request->input("section_title_{$locale}")
                    ];
                }

                $value['contact-info'] = [
                    'phone' => $request->phone ?? "",
                    'mail' => $request->mail ?? "",
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

    public function police_store(Request $request)
    {
        $status = $request->status ?? 'on';
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
        $status = $request->status ?? 'on';
        return $this->storeSettings($request, 'contacts', [
            'section_title_en' => 'required|string|max:255',
            'section_title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'contact-info' => [
                'phone' => $validatedData['phone'] ?? null,
                'mail' => $validatedData['mail'] ?? null,
                'address' => $validatedData['address'] ?? null,
            ],

        ], status: $status);
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
