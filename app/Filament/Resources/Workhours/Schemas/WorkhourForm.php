<?php

namespace App\Filament\Resources\Workhours\Schemas;

use App\Filament\Forms\Components\Scheldue;
use Filament\Schemas\Schema;

class WorkhourForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Scheldue::make('arr')
                    ->options([
                        '#ffffff' => 'Белый',
                        '#241212' => 'Темный',
                        '#ff0000' => 'Красный',
                    ])
                    ->cols(24)
                    ->rows(7),
            ])->columns(1);
    }
}
