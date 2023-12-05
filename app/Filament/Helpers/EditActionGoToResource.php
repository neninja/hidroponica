<?php

namespace App\Filament\Helpers;

use Filament\Tables\Actions\EditAction;

class EditActionGoToResource extends EditAction
{
    public static function make(string $name = null): static
    {
        return parent::make($name)->url(function ($record): string {
            $recordClassName = get_class($record);
            $recordClassName = str_replace('App\\Models\\', '', $recordClassName);
            $resourceClassName = 'App\\Filament\\Resources\\'.$recordClassName.'Resource';

            $url = $resourceClassName::getUrl('edit', ['record' => $record]);

            return $url;
        });
    }
}
