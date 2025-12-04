<?php

namespace App\Filament\Resources\Penilaians\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class PenilaiansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Tampilkan nama alternatif lewat relasi
                Tables\Columns\TextColumn::make('alternatif.nama')
                    ->label('Alternatif')
                    ->sortable()
                    ->searchable(),

                // Tampilkan nama kriteria lewat relasi
                Tables\Columns\TextColumn::make('kriteria.nama')
                    ->label('Kriteria')
                    ->sortable()
                    ->searchable(),

                // Kolom nilai
                Tables\Columns\TextColumn::make('nilai')
                    ->label('Nilai')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            // SENGAJA: tidak pakai EditAction / DeleteBulkAction
            // supaya tidak error Class "Filament\Tables\Actions\EditAction" not found
            ->actions([
                // kosong dulu
            ])
            ->bulkActions([
                // kosong dulu
            ]);
    }
}
