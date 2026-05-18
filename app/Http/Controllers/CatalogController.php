<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CatalogController extends Controller
{
    public function index(Request $request): Response
    {
        $categorySlug = $request->query('category');

        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(fn (Category $c): array => [
                'slug' => $c->slug,
                'name' => $c->getTranslation('name', 'ru'),
                'description' => $c->getTranslation('description', 'ru'),
                'itemCount' => $c->products()->where('is_active', true)->count(),
            ]);

        $productsQuery = Product::where('is_active', true)->with('category:id,slug,name');

        $currentCategory = null;

        if ($categorySlug) {
            $currentCategory = Category::where('slug', $categorySlug)->where('is_active', true)->first();
            if ($currentCategory) {
                $productsQuery->where('category_id', $currentCategory->id);
            }
        }

        $products = $productsQuery->latest()->get()->map(fn (Product $p): array => [
            'id' => $p->id,
            'slug' => $p->slug,
            'name' => $p->getTranslation('name', 'ru'),
            'sku' => $p->sku,
            'category' => $p->category?->getTranslation('name', 'ru') ?? '',
            'description' => $p->getTranslation('description', 'ru'),
            'image' => $p->image,
            'moq' => $p->moq,
            'leadTime' => $p->lead_time,
            'customization' => $p->customization,
            'isNew' => $p->is_new,
            'discount' => $p->discount_percent,
            'specs' => $p->specs ?? [],
        ]);

        return Inertia::render('CatalogPage', [
            'categories' => $categories,
            'products' => $products,
            'currentCategory' => $currentCategory ? [
                'slug' => $currentCategory->slug,
                'name' => $currentCategory->getTranslation('name', 'ru'),
                'description' => $currentCategory->getTranslation('description', 'ru'),
            ] : null,
        ]);
    }

    public function show(string $slug): Response
    {
        $product = Product::where('is_active', true)->with('category')->where('slug', $slug)->first();

        if (! $product) {
            abort(404);
        }

        $relatedProducts = Product::where('is_active', true)
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(4)
            ->get()
            ->map(fn (Product $p): array => [
                'id' => $p->id,
                'slug' => $p->slug,
                'name' => $p->getTranslation('name', 'ru'),
                'sku' => $p->sku,
                'category' => $p->category?->getTranslation('name', 'ru') ?? '',
                'description' => $p->getTranslation('description', 'ru'),
                'image' => $p->image,
                'moq' => $p->moq,
                'leadTime' => $p->lead_time,
                'customization' => $p->customization,
                'isNew' => $p->is_new,
                'discount' => $p->discount_percent,
                'specs' => $p->specs ?? [],
            ]);

        return Inertia::render('ProductPage', [
            'product' => [
                'id' => $product->id,
                'slug' => $product->slug,
                'name' => $product->getTranslation('name', 'ru'),
                'sku' => $product->sku,
                'category' => $product->category?->getTranslation('name', 'ru') ?? '',
                'description' => $product->getTranslation('description', 'ru'),
                'image' => $product->image,
                'moq' => $product->moq,
                'leadTime' => $product->lead_time,
                'customization' => $product->customization,
                'isNew' => $product->is_new,
                'discount' => $product->discount_percent,
                'specs' => $product->specs ?? [],
                'isActive' => $product->is_active,
            ],
            'relatedProducts' => $relatedProducts,
        ]);
    }
}
