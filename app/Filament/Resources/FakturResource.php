<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Forms;
use App\Models\Stok;
use Filament\Tables;
use App\Models\Harga;
use App\Models\Barang;
use App\Models\Faktur;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\FakturResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\FakturResource\RelationManagers;

class FakturResource extends Resource
{
    protected static ?string $model = Faktur::class;

    protected static ?string $navigationIcon = 'heroicon-o-receipt-refund';
    protected static ?string $navigationLabel = 'Faktur';
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
                                ->lazy()
                                ->afterStateUpdated(function (Closure $set, $state, $get) {
                                    $subtotal = $get('subtotal');
                                    $diskon = $subtotal * ($state / 100);
                                    $hasil = $subtotal - $diskon;
                                    $set('total', Str::slug(intval($hasil)));
                                    
                                    $total = $get('../../total_harga');

                                    $hasil2 = intval($total) + $hasil;
                                    $set('../../total_harga', Str::slug(intval($hasil2)));
                                })
                                ->columnSpan([
                                    'md' => 1,
                                    'lg' => 1
                                ]),
                            Forms\Components\TextInput::make('total')
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
                            $ppn = intval($total) * (intval($state) / 100);
                            $hasil = $total + $ppn;
                            $set('hasilppn', Str::slug(intval($hasil)));
                        })
                        ->columnSpan([
                            'md' => 1,
                            'lg' => 1
                        ]),
                    Textinput::make('hasilppn')
                        ->reactive()
                        ->hidden(),
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
                ])
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.nama_customer')
                    ->label('Nama Customer'),
                Tables\Columns\TextColumn::make('kode_faktur')
                    ->label('Kode Faktur'),
                Tables\Columns\TextColumn::make('tanggal_faktur')
                    ->label('Tanggal Faktur')
                    ->date(),
                Tables\Columns\TextColumn::make('ket_faktur')
                    ->label('Keterangan'),
                Tables\Columns\TextColumn::make('total_harga')
                    ->money('IDR')
                    ->label('Total'),
                Tables\Columns\TextColumn::make('ppn')
                    ->label('PPN'),
                Tables\Columns\TextColumn::make('pph')
                    ->label('PPH'),
                Tables\Columns\TextColumn::make('total_pp')
                    ->money('IDR')
                    ->label('Total Setelah Pajak'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make()
                    ->icon('heroicon-o-trash')
                    ->before(function ($record) {
                        $faktur = DB::table('detail_fakturs')
                            ->join('hargas', 'detail_fakturs.harga_id', 'hargas.id')
                            ->where('faktur_id', $record->id)
                            ->get();

                        foreach ($faktur as $item) {
                            $barang = Barang::find($item->barang_id);
                            // Maka Table barang kolom stok barang dilakukan update dari (Table Barang kolom Stok) dikurangi dari (Table Stok kolom stok Masuk)
                            $barang->update([
                                'stok' => $barang->stok + $item->stok_keluar,
                            ]);
                        }

                    })
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
