<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ParticipantResource\Pages;
use App\Filament\Resources\ParticipantResource\RelationManagers;
use App\Filament\Resources\ParticipantResource\RelationManagers\ProfileRelationManager;
use App\Models\Participant;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ParticipantResource extends Resource
{
    protected static ?string $model = Participant::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->whereHas( 'transaction', function ($query) {
                $query->where('status', Transaction::TRANSACTION_STATUS_SUCCESS);
            }))
            ->groups([
                'event.id',
            ])
            ->columns([
                Tables\Columns\TextColumn::make('profile.last_name')->label('nom'),
                Tables\Columns\TextColumn::make('profile.first_name')->label('prenom'),
                Tables\Columns\TextColumn::make('profile.email')->label('email'),
                Tables\Columns\TextColumn::make('profile.phone_number')->label('numero de telephone'),
                Tables\Columns\TextColumn::make('profile.promotion')->label('promotion'),
                Tables\Columns\TextColumn::make('profile.profession')->label('profession'),
                Tables\Columns\TextColumn::make('profile.country')->label('pays'),
                Tables\Columns\TextColumn::make('profile.city')->label('ville'),
            ])
            ->filters([
                //
            ])
            ->actions([
            ])
            ->bulkActions([
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListParticipants::route('/'),
            'create' => Pages\CreateParticipant::route('/create'),
            'edit' => Pages\EditParticipant::route('/{record}/edit'),
        ];
    }
}
