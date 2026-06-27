<?php

use App\Models\User;
use Illuminate\Support\Facades\App;

test('default locale is english', function () {
    expect(App::getLocale())->toBe('en');
});

test('locale is set from cookie', function () {
    $this->withCookie('locale', 'ru')->get('/');

    expect(App::getLocale())->toBe('ru');
});

test('locale falls back to browser preference', function () {
    $this->withHeader('Accept-Language', 'ru-RU,ru;q=0.9')->get('/');

    expect(App::getLocale())->toBe('ru');
});

test('locale falls back to config when no preference', function () {
    $this->withHeader('Accept-Language', '')->get('/');

    expect(App::getLocale())->toBe('en');
});

test('json translations are shared with inertia', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get(route('dashboard'));

    $response->assertInertia(fn ($page) => $page
        ->has('locale')
        ->has('translations')
        ->where('locale', 'en')
    );
});

test('russian locale loads ru translations', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $this->withCookie('locale', 'ru')->get(route('dashboard'));

    expect(App::getLocale())->toBe('ru');
});

test('locale switch sets cookie and redirects back', function () {
    $response = $this->get(route('locale.switch', 'ru'));

    $response->assertRedirect('/');
    $response->assertCookie('locale', 'ru');
});

test('locale switch rejects invalid locale', function () {
    $response = $this->get(route('locale.switch', 'fr'));

    $response->assertStatus(400);
});
