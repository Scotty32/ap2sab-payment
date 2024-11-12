<?php

namespace App\Filament\Resources\EventResource\RelationManagers;

use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ParticipantsRelationManager extends RelationManager
{
    protected static string $relationship = 'participants';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->whereHas( 'transaction', function ($query) {
                $query->where('status', Transaction::TRANSACTION_STATUS_SUCCESS);
            }))
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
                Tables\Columns\TextColumn::make('transaction.amount')->label('montant'),
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
