<?php

namespace App\Filament\Resources\Penilaians\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PenilaianForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('alternatif_id')
                    ->required()
                    ->numeric(),
                TextInput::make('kriteria_id')
                    ->required()
                    ->numeric(),
                TextInput::make('nilai')
                    ->required()
                    ->numeric(),
            ]);
    }
}
