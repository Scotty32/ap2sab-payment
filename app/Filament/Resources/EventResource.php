<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Filament\Resources\EventResource\RelationManagers\ParticipantsRelationManager;
use App\Filament\Resources\ParticipantResource\Pages\ListParticipants;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Evenement';
    protected static ?string $pluiralModelLabel = 'Evenements';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informations sur l\'évenement')
                    ->schema([
                        TextInput::make('title')
                            ->label(__('admin.event.title.label'))
                            ->required(),
                        TextInput::make('short_description')
                            ->label(__('admin.event.short_description.label'))
                            ->required(),
                        DatePicker::make('date')
                            ->format('d/m/Y')
                            ->label(__('admin.event.date.label'))
                            ->required(),
                    ])
                    ->columns(3),
                Section::make('Montant de la participation')
                    ->description('veuillez indiquer le montant que chaque participant devra payer')
                    ->schema([
                        TextInput::make('participation_amount_amount')
                            ->label(__('admin.event.participation_amount.amount'))
                            ->required()
                            ->numeric()
                            ->columnSpan(2), 
                        Select::make('participation_amount_currency')
                            ->options([
                                'XOF' => 'FCFA',
                            ])
                            ->default('XOF')
                            ->columnSpan(1)
                            ->label(__('admin.event.participation_amount.currency'))
                    ])
                    ->columns(6),
                RichEditor::make('long_description')
                    ->label(__('admin.event.long_description.label'))
                    ->required()
                    ->columnSpan(2),
                FileUpload::make('image_url')->label('Image')
                    ->disk('public')
                    ->directory('events-images')
                    ->default('default-image.jpg')
                    ->image()        
                    ->imageEditor()
                    ->required()
                    ->columnSpan(2)        
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label(__('admin.event.title.label')),
                Tables\Columns\TextColumn::make('short_description')->label(__('admin.event.short_description.label')),
                Tables\Columns\TextColumn::make('participation_amount')->label(__('admin.event.participation_amount.label')),
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
            ParticipantsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'view' => Pages\ViewParticipants::route('/{record}'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
