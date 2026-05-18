<?php

namespace App\Http\Middleware;

use App\Models\Category;
use App\Models\Setting;
use Illuminate\Http\Request;
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
        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(fn (Category $c): array => [
                'slug' => $c->slug,
                'name' => $c->getTranslation('name', 'ru'),
                'itemCount' => $c->products()->where('is_active', true)->count(),
            ]);

        $settings = Setting::all()->mapWithKeys(
            fn (Setting $s): array => [$s->key => $s->value['ru'] ?? ''],
        )->toArray();

        return [
            ...parent::share($request),
            'name' => config('app.name'),
            'auth' => [
                'user' => $request->user(),
            ],
            'sidebarOpen' => ! $request->hasCookie('sidebar_state') || $request->cookie('sidebar_state') === 'true',
            'sharedCategories' => $categories,
            'sharedSettings' => $settings,
        ];
    }
}
