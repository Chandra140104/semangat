<?php

namespace App\Filament\Resources\Alternatifs\Pages;

use App\Filament\Resources\Alternatifs\AlternatifResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAlternatifs extends ListRecords
{
    protected static string $resource = AlternatifResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
