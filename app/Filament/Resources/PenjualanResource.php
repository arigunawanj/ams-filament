<?php

namespace App\Filament\Resources;

use stdClass;
use Filament\Forms;
use Filament\Tables;
use App\Models\Penjualan;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\BooleanColumn;
use App\Filament\Resources\PenjualanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Archilex\ToggleIconColumn\Columns\ToggleIconColumn;
use App\Filament\Resources\PenjualanResource\RelationManagers;

class PenjualanResource extends Resource
{
    protected static ?string $model = Penjualan::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Laporan Penjualan';
    protected static ?string $navigationGroup = 'Laporan';
    public static ?string $label = 'Laporan Penjualan';
    protected static ?int $navigationSort = 14;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    Toggle::make('status')
                        ->onIcon('heroicon-s-lightning-bolt')
                        ->offIcon('heroicon-s-user')
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')->getStateUsing(
                    static function (stdClass $rowLoop, HasTable $livewire): string {
                        return (string) ($rowLoop->iteration +
                            ($livewire->tableRecordsPerPage * ($livewire->page - 1
                            ))
                        );
                    }
                ),
                BadgeColumn::make('kode')
                    ->label('Kode Faktur')
                    ->copyable()
                    ->sortable()
                    ->copyMessage('Berhasil Disalin')
                    ->searchable(),
                TextColumn::make('customer.nama_customer')
                    ->label('Nama Customer')
                    ->copyable()
                    ->sortable()
                    ->copyMessage('Berhasil Disalin')
                    ->searchable(),
                TextColumn::make('tanggal_kirim')
                    ->label('Tanggal')
                    ->copyable()
                    ->sortable()
                    ->copyMessage('Berhasil Disalin')
                    ->date()
                    ->searchable(),
                TextColumn::make('jumlah')
                    ->copyable()
                    ->sortable()
                    ->copyMessage('Berhasil Disalin')
                    ->label('Jumlah')
                    ->money('IDR')
                    ->searchable(),
                TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->copyable()
                    ->sortable()
                    ->copyMessage('Berhasil Disalin')
                    ->placeholder('-')
                    ->searchable(),
                ToggleIconColumn::make('status')
                    ->label('Lunas')
                    ->alignCenter()
                    ->onColor('primary')
                    ->offColor('danger')
                    ->sortable()
                    ->size('xl'),

            ])
            ->poll('3s')
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
            'index' => Pages\ListPenjualans::route('/'),
            'create' => Pages\CreatePenjualan::route('/create'),
            'edit' => Pages\EditPenjualan::route('/{record}/edit'),
        ];
    }
}
