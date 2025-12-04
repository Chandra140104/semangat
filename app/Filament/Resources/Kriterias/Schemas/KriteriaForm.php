<?php

namespace App\Filament\Resources\Kriterias\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class KriteriaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode')
                    ->required(),
                TextInput::make('nama')
                    ->required(),
                Select::make('tipe')
                    ->options(['benefit' => 'Benefit', 'cost' => 'Cost'])
                    ->required(),
                TextInput::make('bobot')
                    ->required()
                    ->numeric(),
                Textarea::make('keterangan')
                    ->columnSpanFull(),
            ]);
    }
}
