<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Vacancy extends Model
{
    use HasTranslations;

    public array $translatable = ['title', 'description', 'requirements', 'conditions'];

    protected $fillable = [
        'slug',
        'title',
        'description',
        'requirements',
        'conditions',
        'is_urgent',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_urgent' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
