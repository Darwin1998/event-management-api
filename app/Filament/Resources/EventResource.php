<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make('title')->required(),
                    RichEditor::make('description')
                            ->disableAllToolbarButtons()
                            ->enableToolbarButtons([
                                'bold',
                                'bulletList',
                                'italic',
                                'strike',
                            ])->required(),
                    TextInput::make('location')->required(),
                    Select::make('status')->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ]),
                    DateTimePicker::make('start_date')->withoutSeconds()->required(),
                    DateTimePicker::make('end_date')->withoutSeconds()->required(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
                TextColumn::make('description')->limit(20),
                TextColumn::make('location'),
                TextColumn::make('status')->color('success'),
                TextColumn::make('start_date')->dateTime($format = 'F j, Y h:i a'),
                TextColumn::make('end_date')->dateTime($format = 'F j, Y  h:i a'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->button()->color('success'),
                Tables\Actions\ViewAction::make()->button()->color('primary'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
