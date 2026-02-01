<?php

namespace App\Filament\Resources\Workhours;

use App\Filament\Resources\Workhours\Pages\CreateWorkhour;
use App\Filament\Resources\Workhours\Pages\DebugWorkhour;
use App\Filament\Resources\Workhours\Pages\EditWorkhour;
use App\Filament\Resources\Workhours\Pages\ListWorkhours;
use App\Filament\Resources\Workhours\Pages\ViewWorkhour;
use App\Filament\Resources\Workhours\Schemas\WorkhourForm;
use App\Filament\Resources\Workhours\Schemas\WorkhourInfolist;
use App\Filament\Resources\Workhours\Tables\WorkhoursTable;
use App\Models\Workhour;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class WorkhourResource extends Resource
{
    protected static ?string $model = Workhour::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return WorkhourForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return WorkhourInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WorkhoursTable::configure($table);
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
            'index' => ListWorkhours::route('/'),
            'create' => CreateWorkhour::route('/create'),
            'view' => ViewWorkhour::route('/{record}'),
            'edit' => EditWorkhour::route('/{record}/edit'),
            // 'debug' => DebugWorkhour::route('/{record}/debug'),
        ];
    }
}
