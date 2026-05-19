<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasTranslations;

    public array $translatable = ['title', 'content'];

    protected $fillable = [
        'slug',
        'title',
        'content',
        'meta_title',
        'meta_description',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
