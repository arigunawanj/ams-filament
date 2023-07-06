<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Pajak;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PajakResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PajakResource\RelationManagers;

class PajakResource extends Resource
{
    protected static ?string $model = Pajak::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';
    protected static ?string $navigationLabel = 'Faktur Pajak';
    protected static ?string $navigationGroup = 'Pendataan';
    protected static ?int $navigationSort = 15;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    Select::make('customer_id')
                        ->relationship('customer', 'nama_customer')
                        ->label('Nama Customer')
                        ->required(),
                    Forms\Components\TextInput::make('kode_laporan')
                        ->required()
                        ->label('Kode Laporan')
                        ->unique(ignoreRecord: true)
                        ->maxLength(255),
                    Forms\Components\DatePicker::make('tanggal_rep')
                        ->label('Tanggal Laporan')
                        ->required(),
                    Forms\Components\TextInput::make('no_fakpajak')
                        ->required()
                        ->label('No. Faktur Pajak')
                        ->maxLength(255),
                    Forms\Components\DatePicker::make('tanggal_upload')
                        ->label('Tanggal Upload')
                        ->required(),
                    Forms\Components\TextInput::make('ket_rep')
                        ->label('Keterangan')
                        ->maxLength(255),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                BadgeColumn::make('kode_laporan')
                    ->copyable()
                    ->color('primary')
                    ->copyMessage('Berhasil Disalin')
                    ->label('Kode Laporan'),
                Tables\Columns\TextColumn::make('customer.nama_customer')
                    ->copyable()
                    ->copyMessage('Berhasil Disalin')
                    ->label('Nama Customer'),
                Tables\Columns\TextColumn::make('tanggal_rep')
                    ->copyable()
                    ->copyMessage('Berhasil Disalin')
                    ->date()
                    ->label('Tanggal laporan'),
                Tables\Columns\TextColumn::make('no_fakpajak')
                    ->copyable()
                    ->copyMessage('Berhasil Disalin')
                    ->label('No. Faktur Pajak'),
                Tables\Columns\TextColumn::make('tanggal_upload')
                    ->date()
                    ->copyable()
                    ->copyMessage('Berhasil Disalin')
                    ->label('Tanggal Upload'),
                Tables\Columns\TextColumn::make('ket_rep')
                    ->copyable()
                    ->copyMessage('Berhasil Disalin')
                    ->placeholder('-')
                    ->label('Keterangan'),
            ])
            ->poll('3s')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPajaks::route('/'),
            'create' => Pages\CreatePajak::route('/create'),
            'edit' => Pages\EditPajak::route('/{record}/edit'),
        ];
    }
}
