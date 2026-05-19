<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'group',
        'type',
    ];

    protected function casts(): array
    {
        return [
            'value' => 'array',
        ];
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        $setting = static::where('key', $key)->first();

        return $setting ? $setting->value['ru'] ?? $setting->value : $default;
    }

    public static function set(string $key, array $value, string $group = 'general', string $type = 'text'): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group, 'type' => $type],
        );
    }
}
