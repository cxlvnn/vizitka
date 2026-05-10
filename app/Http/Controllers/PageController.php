<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    public function home(): Response
    {
        return Inertia::render('HomePage');
    }

    public function about(): Response
    {
        return Inertia::render('AboutPage');
    }
}
