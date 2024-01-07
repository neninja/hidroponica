<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum LanguageType: string implements HasLabel
{
    case English = 'en';
    case BrazilianPortuguese = 'pt-br';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::English => 'Inglês',
            self::BrazilianPortuguese => 'Português',
        };
    }

    public static function filamentOptions(): array
    {
        return [
            self::English->value => 'Inglês',
            self::BrazilianPortuguese->value => 'Português',
        ];
    }
}
