<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ContributorsRelationManager extends RelationManager
{
    protected static string $relationship = 'contributors';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('profile.last_name')->label('nom'),
                Tables\Columns\TextColumn::make('profile.first_name')->label('prenom'),
                Tables\Columns\TextColumn::make('profile.email')->label('email'),
                Tables\Columns\TextColumn::make('profile.phone_number')->label('numero de telephone'),
                Tables\Columns\TextColumn::make('profile.promotion')->label('promotion'),
                Tables\Columns\TextColumn::make('profile.profession')->label('profession'),
                Tables\Columns\TextColumn::make('profile.country')->label('pays'),
                Tables\Columns\TextColumn::make('profile.city')->label('ville'),
                Tables\Columns\TextColumn::make('transaction.status'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
