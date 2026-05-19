<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\QuoteRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ContactController extends Controller
{
    public function index(Request $request): Response
    {
        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(fn (Category $c): array => [
                'slug' => $c->slug,
                'name' => $c->getTranslation('name', 'ru'),
            ]);

        return Inertia::render('ContactPage', [
            'product' => $request->query('product'),
            'categories' => $categories,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'product_interest' => ['nullable', 'string', 'max:255'],
            'quantity' => ['nullable', 'string', 'max:255'],
            'message' => ['nullable', 'string', 'max:5000'],
        ]);

        QuoteRequest::create(array_merge($validated, ['status' => 'new']));

        return redirect() - back()->with('success', 'Заявка отправлена! Мы свяжемся с вами в течение рабочего дня.');
    }
}
