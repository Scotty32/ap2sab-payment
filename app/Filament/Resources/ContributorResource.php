<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContributorResource\Pages;
use App\Models\Contributor;
use App\Models\Transaction;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ContributorResource extends Resource
{
    protected static ?string $model = Contributor::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    protected static ?string $modelLabel = 'Donateur';
    protected static ?string $pluiralModelLabel = 'Donateurs';

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
            ->modifyQueryUsing(fn (Builder $query) => $query->whereHas( 'transaction', function ($query) {
                $query->where('status', Transaction::TRANSACTION_STATUS_SUCCESS);
            }))
            ->groups([
                Group::make('project.title')
                ->label(__('admin.project.title.label')),
            ])
            ->defaultGroup('project.title')
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
            'index' => Pages\ListContributors::route('/'),
            'create' => Pages\CreateContributor::route('/create'),
            'edit' => Pages\EditContributor::route('/{record}/edit'),
        ];
    }
}
