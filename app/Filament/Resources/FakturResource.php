<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Harga;
use App\Models\Faktur;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Closure;
use Illuminate\Support\Str;
use App\Filament\Resources\FakturResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\FakturResource\RelationManagers;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;

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
                        ->searchable()
                        ->relationship('customer', 'nama_customer')
                        ->columnSpan([
                            'sm' => 1,
                            'md' => 2,
                            'lg' => 2
                        ]),
                    TextInput::make('kode_faktur')
                        ->required()
                        ->label('Kode Faktur')
                        ->maxLength(255)
                        ->columnSpan([
                            'sm' => 1,
                            'md' => 1,
                            'lg' => 1
                        ]),
                    Forms\Components\DatePicker::make('tanggal_faktur')
                        ->label('Tanggal Faktur')
                        ->required()
                        ->columnSpan([
                            'sm' => 2,
                            'md' => 1,
                            'lg' => 1
                        ]),
                    Textarea::make('ket_faktur')
                        ->required()
                        ->label('Keterangan')
                        ->maxLength(255)
                        ->columnSpan([
                            'md' => 2,
                            'lg' => 2
                        ]),
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
                                ->afterStateUpdated(function ($state, callable $set) {
                                    $harga = Harga::find($state);

                                    if ($harga) {
                                        $set('harga', Str::slug($harga->harga));
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
                                ->prefix('Rp')
                                ->mask(
                                    fn (TextInput\Mask $mask) => $mask
                                        ->numeric()
                                        ->decimalPlaces(2)
                                        ->decimalSeparator(',')
                                        ->thousandsSeparator('.')
                                )
                                ->columnSpan([
                                    'md' => 2,
                                    'lg' => 2
                                ]),
                            Forms\Components\TextInput::make('stok_keluar')
                                ->required()
                                ->numeric()
                                ->reactive()
                                ->afterStateUpdated(function (Closure $set, $state, $get) {
                                    $tampung = $get('harga');
                                    $set('subtotal', Str::slug($state * $tampung));
                                })
                                ->columnSpan([
                                    'md' => 1,
                                    'lg' => 1
                                ]),
                            Forms\Components\TextInput::make('subtotal')
                                ->required()
                                ->numeric()
                                ->reactive()
                                ->prefix('Rp')
                                ->mask(
                                    fn (TextInput\Mask $mask) => $mask
                                        ->numeric()
                                        ->decimalPlaces(2)
                                        ->decimalSeparator(',')
                                        ->thousandsSeparator('.')
                                )
                                ->columnSpan([
                                    'md' => 1,
                                    'lg' => 1
                                ]),
                            Forms\Components\TextInput::make('diskon')
                                ->required()
                                ->numeric()
                                ->reactive()
                                ->afterStateUpdated(function (Closure $set, $state, $get) {
                                    $subtotal = $get('subtotal');
                                    $diskon = $subtotal * ($state / 100);
                                    $hasil = $subtotal - $diskon;
                                    $set('total', Str::slug(round($hasil)));
                                })
                                ->columnSpan([
                                    'md' => 1,
                                    'lg' => 1
                                ]),
                            Forms\Components\TextInput::make('total')
                                ->required()
                                ->numeric()
                                ->prefix('Rp')
                                ->reactive()
                                ->afterStateUpdated(fn ($state, callable $set) =>
                                $set('../../total_harga', Str::slug($state)))
                                ->mask(
                                    fn (TextInput\Mask $mask) => $mask
                                        ->numeric()
                                        ->decimalPlaces(2)
                                        ->decimalSeparator(',')
                                        ->thousandsSeparator('.')
                                )

                                ->columnSpan([
                                    'md' => 1,
                                    'lg' => 1
                                ]),
                        ])
                        ->columns(2)
                        ->columnSpan(2),
                    Forms\Components\TextInput::make('total_harga')
                        ->reactive()
                        ->label('Total Harga')
                        ->required()
                        ->columnSpan([
                            'md' => 2,
                            'lg' => 2
                        ]),
                    Select::make('ppn')
                        ->required()
                        ->options([
                            0 => 0,
                            11 => 11
                        ])
                        ->label('PPN')
                        ->reactive()
                        ->afterStateUpdated(function (Closure $set, $state, $get) {
                            $total = $get('total_harga');
                            $ppn = $total * ($state / 100);
                            $hasil = $total + $ppn;
                            $set('hasilppn', Str::slug($hasil));
                        })
                        ->columnSpan([
                            'md' => 1,
                            'lg' => 1
                        ]),
                    Hidden::make('hasilppn')
                        ->reactive(),
                    Select::make('pph')
                        ->required()
                        ->label('PPH')
                        ->options([
                            0 => 0,
                            "1.5" => 1.5
                        ])
                        ->reactive()
                        ->afterStateUpdated(function (Closure $set, $state, $get) {
                            $total = $get('hasilppn');
                            $pph = $total * (floatval($state) / 100);
                            $hasil = intval($total) + floatval($pph);
                            $set('total_pp', Str::slug(round($hasil)));
                        })
                        ->columnSpan([
                            'md' => 1,
                            'lg' => 1
                        ]),
                    Forms\Components\TextInput::make('total_pp')
                        ->label('Total Setelah Pajak')
                        ->required()
                        ->columnSpan([
                            'md' => 2,
                            'lg' => 2
                        ]),
                ])
                    ->columns(2)
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
