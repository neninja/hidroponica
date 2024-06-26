<?php

namespace App\Filament\Resources;

use App\Enums\LanguageType;
use App\Filament\Resources\TextResource\Pages;
use App\Filament\Resources\TextResource\RelationManagers\SentencesRelationManager;
use App\Models\Text;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class TextResource extends Resource
{
    protected static ?string $model = Text::class;

    protected static ?string $label = 'Texto';

    protected static ?string $pluralLabel = 'Textos';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->label('Título'),
                Checkbox::make('is_active')->default(true)->label('Ativo'),
                Checkbox::make('is_demo')->default(true)->label('Demonstrativo'),
                Select::make('language')
                    ->required()
                    ->options(LanguageType::filamentOptions())
                    ->label('Idioma'),
                FileUpload::make('audio')
                    ->acceptedFileTypes(['audio/mpeg'])
                    ->getUploadedFileNameForStorageUsing(
                        fn ($record) => Str::kebab($record->name)
                    )
                    ->downloadable()
                    ->moveFiles()
                    ->directory('audios')
                    ->label('Áudio'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nome'),
                TextColumn::make('language')->label('Idioma'),
                CheckboxColumn::make('is_active')->label('Ativo'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            SentencesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTexts::route('/'),
            'create' => Pages\CreateText::route('/create'),
            'view' => Pages\ViewText::route('/{record}'),
            'edit' => Pages\EditText::route('/{record}/edit'),
        ];
    }
}
