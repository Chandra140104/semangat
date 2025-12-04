<?php

namespace App\Filament\Resources\Alternatifs\Pages;

use App\Filament\Resources\Alternatifs\AlternatifResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAlternatif extends EditRecord
{
    protected static string $resource = AlternatifResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
