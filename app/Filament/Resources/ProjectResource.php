<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Filament\Resources\ProjectResource\RelationManagers\ContributorsRelationManager;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Projet';
    protected static ?string $pluiralModelLabel = 'Projets';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->label(__('admin.project.title.label')),
                DatePicker::make('end_date')
                    ->label(__('admin.project.end_date.label'))
                    ->required(),
                Section::make('Montant du projet')->label(__('admin.project.required_amount.label'))
                    ->schema([
                        TextInput::make('required_amount_amount')
                            ->label(__('admin.project.required_amount.amount'))
                            ->columnSpan(2)
                            ->numeric()
                            ->required(),
                        Select::make('required_amount_currency')
                            ->label(__('admin.project.required_amount.currency'))
                            ->required()
                            ->options([
                                'XOF' => 'FCFA',
                            ])
                            ->default('XOF')
                            ->columnSpan(1),
                    ])
                    ->columns(6),
                RichEditor::make('description')
                    ->label(__('admin.project.description.label'))
                    ->required()
                    ->columnSpan(2),
                FileUpload::make('image_url')
                    ->label('image')
                    ->disk('public')
                    ->directory('projects-images')
                    ->image()        
                    ->imageEditor()
                    ->required()
                    ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label(__('admin.project.title.label')),
                Tables\Columns\TextColumn::make('required_amount')->label(__('admin.project.required_amount.label')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Modifier'),
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ContributorsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
