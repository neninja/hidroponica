<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TranslatedSentenceResource\Pages;
use App\Models\TranslatedSentence;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TranslatedSentenceResource extends Resource
{
    protected static ?string $model = TranslatedSentence::class;

    protected static ?string $label = 'Sentença traduzida';

    protected static ?string $pluralLabel = 'Sentenças traduzidas';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTranslatedSentences::route('/'),
            'create' => Pages\CreateTranslatedSentence::route('/create'),
            'edit' => Pages\EditTranslatedSentence::route('/{record}/edit'),
        ];
    }
}
