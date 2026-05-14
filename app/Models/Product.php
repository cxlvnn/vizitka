<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations;

    public array $translatable = ['name', 'description'];

    protected $fillable = [
        'slug',
        'sku',
        'name',
        'description',
        'category_id',
        'specs',
        'moq',
        'lead_time',
        'customization',
        'is_new',
        'is_featured',
        'is_active',
        'discount_percent',
        'image',
        'gallery',
    ];

    protected function casts(): array
    {
        return [
            'specs' => 'array',
            'gallery' => 'array',
            'customization' => 'boolean',
            'is_new' => 'boolean',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'discount_percent' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
