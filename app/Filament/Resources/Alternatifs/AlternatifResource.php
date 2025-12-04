<?php

namespace App\Filament\Resources\Alternatifs;

use App\Filament\Resources\Alternatifs\Pages\CreateAlternatif;
use App\Filament\Resources\Alternatifs\Pages\EditAlternatif;
use App\Filament\Resources\Alternatifs\Pages\ListAlternatifs;
use App\Filament\Resources\Alternatifs\Schemas\AlternatifForm;
use App\Filament\Resources\Alternatifs\Tables\AlternatifsTable;
use App\Models\Alternatif;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AlternatifResource extends Resource
{
    protected static ?string $model = Alternatif::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nama';

    public static function form(Schema $schema): Schema
    {
        return AlternatifForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AlternatifsTable::configure($table);
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
            'index' => ListAlternatifs::route('/'),
            'create' => CreateAlternatif::route('/create'),
            'edit' => EditAlternatif::route('/{record}/edit'),
        ];
    }
}
