<?php

namespace App\Filament\Resources\EventResource\Pages;

use App\Filament\Resources\EventResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\Page;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ViewParticipants extends ViewRecord
{
    protected static string $resource = EventResource::class;

}
