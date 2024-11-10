<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Models\Profile;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MemberResource extends Resource
{
    protected static ?string $model = Profile::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Membre';
    protected static ?string $pluiralModelLabel = 'Membres';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('last_name')
                    ->required()
                    ->label('Nom'),
                TextInput::make('first_name')
                    ->required()
                    ->label(__('Prenom')),
                TextInput::make('email')
                    ->required()
                    ->email()
                    ->label(__('Email')),
                TextInput::make('phone_number')
                    ->required()
                    ->tel()
                    ->label(__('Numero de telephone')),
                TextInput::make('promotion')
                    ->required()
                    ->numeric()
                    ->label(__('Promotion')),
                TextInput::make('profession')
                    ->label(__('Profession')),
                TextInput::make('country')
                    ->required()
                    ->label(__('Pays')),
                TextInput::make('city')
                    ->required()
                    ->label(__('Ville')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('last_name')->label('nom'),
                Tables\Columns\TextColumn::make('first_name')->label('prenom'),
                Tables\Columns\TextColumn::make('email')->label('email'),
                Tables\Columns\TextColumn::make('phone_number')->label('numero de telephone'),
                Tables\Columns\TextColumn::make('promotion')->label('promotion'),
                Tables\Columns\TextColumn::make('profession')->label('profession'),
                Tables\Columns\TextColumn::make('country')->label('pays'),
                Tables\Columns\TextColumn::make('city')->label('ville'),
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
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }
}
