<?php

namespace App\Filament\Resources\EmployeePostTypeResource\Pages;

use App\Filament\Resources\EmployeePostTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmployeePostType extends EditRecord
{
    protected static string $resource = EmployeePostTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
