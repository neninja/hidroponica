<?php

namespace App\Models;

use App\Enums\LanguageType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Text extends Model
{
    use HasFactory;

    protected $casts = [
        'language' => LanguageType::class,
    ];

    public function sentences(): HasMany
    {
        return $this->hasMany(Sentence::class);
    }
}
