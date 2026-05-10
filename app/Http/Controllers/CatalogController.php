<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CatalogController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('CatalogPage', [
            'category' => $request->query('category'),
        ]);
    }

    public function show(string $slug): Response
    {
        return Inertia::render('ProductPage', [
            'slug' => $slug,
        ]);
    }
}
