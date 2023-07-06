<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Setoran;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SetoranResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SetoranResource\RelationManagers;
use App\Models\Penjualan;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Support\Facades\DB;

class SetoranResource extends Resource
{
    protected static ?string $model = Setoran::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Setoran';
    protected static ?string $navigationGroup = 'Pendataan';
    protected static ?int $navigationSort = 12;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    Select::make('customer_id')
                        ->label('Nama Customer')
                        ->columnSpan(2)
                        ->relationship('customer', 'nama_customer'),
                    Forms\Components\TextInput::make('kode_dep')
                        ->required()
                        ->label('Kode Setoran')
                        ->unique()
                        ->maxLength(255),
                    Forms\Components\DatePicker::make('tanggal_dep')
                        ->label('Tanggal Setoran')
                        ->required(),
                    TextInput::make('jumlah_masuk')
                        ->label('Jumlah Masuk')
                        ->prefix('Rp')
                        ->mask(
                            fn (TextInput\Mask $mask) => $mask
                                ->numeric()
                                ->decimalPlaces(2)
                                ->decimalSeparator(',')
                                ->thousandsSeparator('.')
                        )
                        ->required(),
                    TextInput::make('jumlah_keluar')
                        ->label('Jumlah Keluar')
                        ->prefix('Rp')
                        ->mask(
                            fn (TextInput\Mask $mask) => $mask
                                ->numeric()
                                ->decimalPlaces(2)
                                ->decimalSeparator(',')
                                ->thousandsSeparator('.')
                        )
                        ->required(),
                    FileUpload::make('foto_dep')
                        ->columnSpan(2)
                        ->directory('setoran/foto')
                        ->label('Lampiran'),
                    Textarea::make('ket_dep')
                        ->label('Keterangan')
                        ->columnSpan(2)
                        ->maxLength(255),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                BadgeColumn::make('kode_dep')
                    ->searchable()
                    ->copyable()
                    ->color('primary')
                    ->copyMessage('Berhasil Disalin')
                    ->sortable()
                    ->label('Kode Setoran'),
                Tables\Columns\TextColumn::make('customer.nama_customer')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Berhasil Disalin')
                    ->sortable()
                    ->label('Nama Customer'),
                Tables\Columns\TextColumn::make('tanggal_dep')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Berhasil Disalin')
                    ->sortable()
                    ->label('Tanggal Setoran')
                    ->date(),
                Tables\Columns\TextColumn::make('jumlah_masuk')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Berhasil Disalin')
                    ->sortable()
                    ->label('Jumlah Masuk')
                    ->money('IDR'),
                Tables\Columns\TextColumn::make('jumlah_keluar')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Berhasil Disalin')
                    ->sortable()
                    ->label('Jumlah Keluar')
                    ->money('IDR'),
                Tables\Columns\TextColumn::make('foto_dep')
                    ->label('Foto')
                    ->placeholder('-'),
                Tables\Columns\TextColumn::make('ket_dep')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Berhasil Disalin')
                    ->sortable()
                    ->placeholder('-')
                    ->label('Keterangan'),
            ])
            ->poll('3s')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make()
                    ->icon('heroicon-o-trash')
                    ->before(function ($record) {
                        DB::table('penjualans')->where('kode', $record->kode_dep)->delete();
                        
                    }),
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
            'index' => Pages\ListSetorans::route('/'),
            'create' => Pages\CreateSetoran::route('/create'),
            'edit' => Pages\EditSetoran::route('/{record}/edit'),
        ];
    }
}
