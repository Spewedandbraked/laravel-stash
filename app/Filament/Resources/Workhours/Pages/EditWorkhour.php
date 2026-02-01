<?php

namespace App\Filament\Resources\Workhours\Pages;

use App\Filament\Resources\Workhours\WorkhourResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditWorkhour extends EditRecord
{
    protected static string $resource = WorkhourResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
