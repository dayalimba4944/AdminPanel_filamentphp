<?php

namespace App\Filament\Resources\BannerResource\Pages;

use App\Filament\Resources\BannerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Pages\Page;

class CreateBanner extends CreateRecord
{
    protected static string $resource = BannerResource::class;

    // protected static string $view = 'filament.pages.create-banner';

    // protected function getHeaderTitle(): string
    // {
    //     return 'Create Banner';
    // }
}
