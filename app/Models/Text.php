<?php

namespace App\Models;

use App\Enums\LanguageType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\Storage;

/**
 * @mixin IdeHelperText
 */
class Text extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'audio',
        'language',
        'is_demo',
        'is_active',
    ];

    protected $casts = [
        'language' => LanguageType::class,
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('demo', function (Builder $builder) {
            if (auth()->user()?->isDemo()) {
                $builder->where('is_demo', true);
            }
        });
    }

    public function sentences(): HasMany
    {
        return $this->hasMany(Sentence::class)->orderBy('start_at', 'asc');
    }

    public function translatedSentences(): HasManyThrough
    {
        return $this->hasManyThrough(TranslatedSentence::class, Sentence::class)->orderBy('start_at', 'asc');
    }

    public function translatedSentencesGroupByLanguage()
    {
        return $this->translatedSentences()->get()->groupBy('language');
    }

    public function audioUrl(): string
    {
        return str_replace('minio:9000', 'localhost:9000', Storage::url($this->audio));
    }
}
