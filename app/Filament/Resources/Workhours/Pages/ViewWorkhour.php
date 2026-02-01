<?php

namespace App\Filament\Resources\Workhours\Pages;

use App\Filament\Resources\Workhours\WorkhourResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewWorkhour extends ViewRecord
{
    protected static string $resource = WorkhourResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
