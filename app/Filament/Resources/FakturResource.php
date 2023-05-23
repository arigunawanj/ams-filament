<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Faktur;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\FakturResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\FakturResource\RelationManagers;
use App\Models\Harga;
use Filament\Forms\Components\Card;
use Illuminate\Support\Facades\DB;

class FakturResource extends Resource
{
    protected static ?string $model = Faktur::class;

    protected static ?string $navigationIcon = 'heroicon-o-receipt-refund';
    protected static ?string $navigationLabel = 'Tambah Barang Faktur';
    protected static ?string $navigationGroup = 'Pendataan';
    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    Select::make('customer_id')
                        ->label('Nama Customer')
                        ->required()
                        ->relationship('customer', 'nama_customer'),
                    Forms\Components\TextInput::make('kode_faktur')
                        ->required()
                        ->label('Kode Faktur')
                        ->maxLength(255),
                    Forms\Components\DatePicker::make('tanggal_faktur')
                        ->required(),
                    Forms\Components\TextInput::make('ket_faktur')
                        ->required()
                        ->maxLength(255),
                    Repeater::make('detail_faktur')
                        ->relationship()
                        ->schema([
                            Select::make('harga_id')
                                ->searchable()
                                ->label('Pilih Barang')
                                ->options(
                                    DB::table('hargas')
                                        ->join('barangs', 'hargas.barang_id', 'barangs.id')
                                        ->pluck('hargas.kode_harga', 'hargas.id')

                                )
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $set){
                                    $harga = Harga::find($state);

                                    if($harga) {
                                        $set('harga', $harga->harga);
                                    }
                                })
                                ->columnSpan([
                                    'sm' => 2,
                                    'md' => 2,
                                    'lg' => 2
                                ]),
                            Forms\Components\TextInput::make('harga')
                                ->required()
                                ->numeric()
                                ->columnSpan([
                                    'md' => 2,
                                    'lg' => 2
                                ]),
                            Forms\Components\TextInput::make('stok_keluar')
                                ->required()
                                ->numeric()
                                ->columnSpan([
                                    'md' => 1,
                                    'lg' => 1
                                ]),
                            Forms\Components\TextInput::make('subtotal')
                                ->required()
                                ->numeric()
                                ->columnSpan([
                                    'md' => 1,
                                    'lg' => 1
                                ]),
                            Forms\Components\TextInput::make('diskon')
                                ->required()
                                ->numeric()
                                ->columnSpan([
                                    'md' => 1,
                                    'lg' => 1
                                ]),
                            Forms\Components\TextInput::make('total')
                                ->required()
                                ->numeric()
                                ->columnSpan([
                                    'md' => 1,
                                    'lg' => 1
                                ]),
                        ])
                        ->columns(2),
                    Forms\Components\TextInput::make('total_harga')
                        ->required(),
                    Forms\Components\TextInput::make('ppn')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('pph')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('total_pp')
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer_id'),
                Tables\Columns\TextColumn::make('kode_faktur'),
                Tables\Columns\TextColumn::make('tanggal_faktur')
                    ->date(),
                Tables\Columns\TextColumn::make('ket_faktur'),
                Tables\Columns\TextColumn::make('total_harga'),
                Tables\Columns\TextColumn::make('ppn'),
                Tables\Columns\TextColumn::make('pph'),
                Tables\Columns\TextColumn::make('total_pp'),
            ])
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
            'index' => Pages\ListFakturs::route('/'),
            'create' => Pages\CreateFaktur::route('/create'),
            'edit' => Pages\EditFaktur::route('/{record}/edit'),
        ];
    }
}
