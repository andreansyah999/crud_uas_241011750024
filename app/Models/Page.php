<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['slug', 'title', 'content', 'additional_metadata'])]
class Page extends Model
{
    protected function casts(): array
    {
        return [
            'additional_metadata' => 'array',
        ];
    }
}
