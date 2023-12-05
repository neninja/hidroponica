<?php

namespace App\Filament\Resources\TranslatedSentenceResource\Pages;

use App\Filament\Resources\TranslatedSentenceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTranslatedSentence extends EditRecord
{
    protected static string $resource = TranslatedSentenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
