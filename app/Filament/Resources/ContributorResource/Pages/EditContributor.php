<?php

namespace App\Filament\Resources\ContributorResource\Pages;

use App\Filament\Resources\ContributorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContributor extends EditRecord
{
    protected static string $resource = ContributorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
