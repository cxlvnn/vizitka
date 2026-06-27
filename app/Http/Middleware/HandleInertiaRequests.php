<?php

namespace App\Http\Middleware;

use App\Models\Category;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $locale = App::getLocale();

        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(fn (Category $c): array => [
                'slug' => $c->slug,
                'name' => $c->getTranslation('name', $locale),
                'itemCount' => $c->products()->where('is_active', true)->count(),
            ]);

        $settings = Setting::all()->mapWithKeys(
            fn (Setting $s): array => [$s->key => $s->value[$locale] ?? $s->value['ru'] ?? ''],
        )->toArray();

        $translations = [];
        $jsonPath = lang_path("{$locale}.json");
        if (file_exists($jsonPath)) {
            $translations = json_decode(file_get_contents($jsonPath), true) ?? [];
        }

        return [
            ...parent::share($request),
            'name' => config('app.name'),
            'locale' => $locale,
            'translations' => $translations,
            'auth' => [
                'user' => $request->user(),
            ],
            'sidebarOpen' => ! $request->hasCookie('sidebar_state') || $request->cookie('sidebar_state') === 'true',
            'sharedCategories' => $categories,
            'sharedSettings' => $settings,
        ];
    }
}
