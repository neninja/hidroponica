<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperSentence
 */
class Sentence extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'start_at',
        'end_at',
    ];

    public function text(): BelongsTo
    {
        return $this->belongsTo(Text::class);
    }

    public function translatedSentences(): HasMany
    {
        return $this->hasMany(TranslatedSentence::class);
    }
}
