<?php

namespace App\Filament\Resources\TextResource\RelationManagers;

use App\Enums\LanguageType;
use App\Models\Sentence;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Table;

class SentencesRelationManager extends RelationManager
{
    protected static string $relationship = 'sentences';

    protected static string $view = 'filament.layouts.text.sentences-relation';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->columns(1)
                    ->schema([
                        TextInput::make('content')
                            ->required()
                            ->maxLength(255),
                        Actions::make([
                            Action::make('deleteSentence')
                                ->label('Deletar sentença')
                                ->icon('heroicon-m-x-mark')
                                ->color('danger')
                                ->requiresConfirmation()
                                ->action(function (Sentence $sentence) {
                                    $sentence->forceDelete();

                                    return true;
                                })
                                ->after(fn () => redirect()->route(
                                    'filament.admin.resources.texts.edit',
                                    ['record' => $this->ownerRecord->id],
                                )),
                        ]),
                        Repeater::make('translatedSentences')
                            ->label('Traduções')
                            ->relationship()
                            ->schema([
                                Select::make('language')
                                    ->required()
                                    ->options(LanguageType::filamentOptions()),
                                TextInput::make('content')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                        Grid::make()
                            ->columns(2)
                            ->schema([
                                TextInput::make('start_at')
                                    ->required()
                                    ->numeric(),
                                TextInput::make('end_at')
                                    ->required()
                                    ->numeric(),
                            ]),
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('sentences')
            ->columns([
                Tables\Columns\TextColumn::make('content'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
