<?php

namespace App\Filament\Resources\Workhours\Pages;

use App\Filament\Resources\Workhours\WorkhourResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWorkhours extends ListRecords
{
    protected static string $resource = WorkhourResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
