<?php

namespace App\Filament\Resources\Workhours\Pages;

use App\Filament\Resources\Workhours\WorkhourResource;
use Filament\Resources\Pages\Page;

class DebugWorkhour extends Page
{
    protected static string $resource = WorkhourResource::class;
    // protected static string $view = 'filament.workhour.debug-workhour';

    public $record;

    public function mount($record)
    {
        $this->record = \App\Models\Workhour::findOrFail($record);
    }
}
