<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SentenceResource\Pages;
use App\Models\Sentence;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SentenceResource extends Resource
{
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $model = Sentence::class;

    protected static ?string $label = 'Sentença';

    protected static ?string $pluralLabel = 'Sentenças';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make('grid')
                    ->columns(1)
                    ->schema([
                        TextInput::make('content')
                            ->required()
                            ->maxLength(255),
                    ]),
                Grid::make('grid')
                    ->columns(2)
                    ->schema([
                        TextInput::make('start_at')
                            ->required()
                            ->numeric(),
                        TextInput::make('end_at')
                            ->required()
                            ->numeric(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('content'),
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
            'index' => Pages\ListSentences::route('/'),
            'create' => Pages\CreateSentence::route('/create'),
            'edit' => Pages\EditSentence::route('/{record}/edit'),
        ];
    }
}
