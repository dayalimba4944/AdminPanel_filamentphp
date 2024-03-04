<?php

namespace App\Filament\Resources\EmployeePostTypeResource\Pages;

use App\Filament\Resources\EmployeePostTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEmployeePostTypes extends ListRecords
{
    protected static string $resource = EmployeePostTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
