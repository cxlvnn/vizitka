<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteRequest extends Model
{
    protected $fillable = [
        'name',
        'company',
        'phone',
        'email',
        'product_interest',
        'quantity',
        'message',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'string',
        ];
    }
}
