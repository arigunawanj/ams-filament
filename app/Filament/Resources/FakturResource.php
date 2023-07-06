<?php

namespace App\Filament\Resources;

use Closure;
use stdClass;
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
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
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
                    Grid::make([
                        'default' => 2,
                        'sm' => 1,
                        'md' => 2,
                        'lg' => 2,
                        'xl' => 2,
                        '2xl' => 2,
                    ])
                        ->schema([
                            Select::make('customer_id')
                                ->label('Nama Customer')
                                ->required()
                                ->relationship('customer', 'nama_customer')
                                ->searchable()
                                ->columnSpan(2),
                            TextInput::make('kode_faktur')
                                ->required()
                                ->label('Kode Faktur')
                                ->unique(ignoreRecord: true)
                                ->maxLength(255)
                                ->columnSpan([
                                    'default' => 2,
                                    'md' => 1,
                                    'lg' => 1,
                                    'xl' => 1
                                ])
                                ->columns(1),
                            Forms\Components\DatePicker::make('tanggal_faktur')
                                ->label('Tanggal Faktur')
                                ->required()
                                ->columnSpan([
                                    'default' => 2,
                                    'md' => 2,
                                    'lg' => 1
                                ]),
                            Textarea::make('ket_faktur')
                                ->label('Keterangan')
                                ->placeholder('Tidak Wajib diisi')
                                ->columnSpan(2)
                                ->maxLength(255),
                            Repeater::make('detail_faktur')
                                ->relationship()
                                ->schema([
                                    Select::make('barang_id')
                                        ->searchable()
                                        ->label('Pilih Barang')
                                        ->options(Barang::all()->pluck('nama_barang', 'id'))
                                        ->reactive()
                                        ->afterStateUpdated(fn (callable $set) => $set('harga_id', null))
                                        ->columnSpan([
                                            'default' => 2,
                                            'md' => 2,
                                            'lg' => 1
                                        ]),
                                    Select::make('harga_id')
                                        ->searchable()
                                        ->label('Pilih Kode Harga')
                                        ->options(function (callable $get) {
                                            $harga = Harga::where('barang_id', $get('barang_id'))->get();
                                            if (!$harga) {
                                                return Harga::all()->pluck('kode_harga', 'id');
                                            }

                                            return $harga->pluck('kode_harga', 'id');
                                        })
                                        ->columnSpan([
                                            'default' => 2,
                                            'md' => 2,
                                            'lg' => 1
                                        ])
                                        ->reactive()
                                        ->afterStateUpdated(function ($state, callable $set) {
                                            $harga = Harga::find($state);

                                            if ($harga) {
                                                $set('harga', Str::slug($harga->harga));
                                            }
                                        }),
                                    Forms\Components\TextInput::make('harga')
                                        ->required()
                                        ->numeric()
                                        ->prefix('Rp')
                                        ->columnSpan([
                                            'default' => 2,
                                            'md' => 2,
                                            'lg' => 1
                                        ])
                                        ->mask(
                                            fn (TextInput\Mask $mask) => $mask
                                                ->numeric()
                                                ->decimalPlaces(2)
                                                ->decimalSeparator(',')
                                                ->thousandsSeparator('.')
                                        ),
                                    Forms\Components\TextInput::make('stok_keluar')
                                        ->required()
                                        ->numeric()
                                        ->reactive()
                                        ->columnSpan([
                                            'default' => 2,
                                            'md' => 2,
                                            'lg' => 1
                                        ])
                                        ->afterStateUpdated(function (Closure $set, $state, $get) {
                                            $tampung = $get('harga');
                                            $set('subtotal', Str::slug($state * $tampung));
                                        }),
                                    Forms\Components\TextInput::make('subtotal')
                                        ->required()
                                        ->numeric()
                                        ->reactive()
                                        ->prefix('Rp')
                                        ->columnSpan([
                                            'default' => 2,
                                            'md' => 2,
                                            'lg' => 1
                                        ])
                                        ->mask(
                                            fn (TextInput\Mask $mask) => $mask
                                                ->numeric()
                                                ->decimalPlaces(2)
                                                ->decimalSeparator(',')
                                                ->thousandsSeparator('.')
                                        ),
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
                                        }),
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
                                        ->columnSpan(2),

                                ])
                                ->columns(2)
                                ->columnSpan(2)
                                ->label('Barang'),
                            Forms\Components\TextInput::make('total_harga')
                                ->reactive()
                                ->label('Total Harga')
                                ->required()
                                ->prefix('Rp')
                                ->columnSpan(2)
                                ->mask(
                                    fn (TextInput\Mask $mask) => $mask
                                        ->numeric()
                                        ->decimalPlaces(2)
                                        ->decimalSeparator(',')
                                        ->thousandsSeparator('.')
                                ),

                            Select::make('ppn2')
                                ->required()
                                ->options([
                                    0 => 0,
                                    11 => 11
                                ])
                                ->label('PPN')
                                ->columnSpan([
                                    'default' => 2,
                                    'md' => 1,
                                    'lg' => 1
                                ])
                                ->reactive()
                                ->afterStateUpdated(function (Closure $set, $state, $get) {
                                    $total = $get('total_harga');
                                    $ppn = intval($total) * (intval($state) / 100);
                                    $hasil = $total + $ppn;
                                    $set('hasilppn', Str::slug(intval($hasil)));
                                    $set('ppn', Str::slug(intval($ppn)));
                                }),

                            Textinput::make('hasilppn')
                                ->reactive()
                                ->prefix('Rp')
                                ->mask(
                                    fn (TextInput\Mask $mask) => $mask
                                        ->numeric()
                                        ->decimalPlaces(2)
                                        ->decimalSeparator(',')
                                        ->thousandsSeparator('.')
                                )
                                ->hidden()
                                ->label('Tampung PPN'),
                            Hidden::make('ppn')
                                ->reactive()
                                ->label('Hasil PPN'),
                            Select::make('pph2')
                                ->required()
                                ->label('PPH')
                                ->columnSpan([
                                    'default' => 2,
                                    'md' => 1,
                                    'lg' => 1
                                ])
                                ->options([
                                    0 => 0,
                                    "1.5" => "1.5"
                                ])
                                ->reactive()
                                ->afterStateUpdated(function (Closure $set, $state, $get) {
                                    $total = $get('hasilppn');
                                    $pph = $total * (floatval($state) / 100);
                                    $hasil = intval($total) + floatval($pph);
                                    $set('total_pp', Str::slug(round($hasil)));
                                    $set('pph', Str::slug(round($pph)));
                                }),
                            Hidden::make('pph')
                                ->reactive()
                                ->label('Hasil PPH'),
                            Forms\Components\TextInput::make('total_pp')
                                ->label('Total Setelah Pajak')
                                ->required()
                                ->prefix('Rp')
                                ->columnSpan(2)
                                ->mask(
                                    fn (TextInput\Mask $mask) => $mask
                                        ->numeric()
                                        ->decimalPlaces(2)
                                        ->decimalSeparator(',')
                                        ->thousandsSeparator('.')
                                ),

                        ])
                        ->columns(2)
                        ->columnSpan(2)
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
                BadgeColumn::make('kode_faktur')
                    ->copyable()
                    ->color('warning')
                    ->searchable()
                    ->sortable()
                    ->copyMessage('Berhasil Disalin')
                    ->label('Kode Faktur'),
                Tables\Columns\TextColumn::make('customer.nama_customer')
                    ->copyable()
                    ->searchable()
                    ->sortable()
                    ->copyMessage('Berhasil Disalin')
                    ->label('Nama Customer'),
                BadgeColumn::make('tanggal_faktur')
                    ->label('Tanggal Faktur')
                    ->color('primary')
                    ->copyable()
                    ->sortable()
                    ->searchable()
                    ->copyMessage('Berhasil Disalin')
                    ->date(),
                // Tables\Columns\TextColumn::make('total_harga')
                //     ->money('IDR')
                //     ->searchable()
                //     ->sortable()
                //     ->copyable()
                //     ->copyMessage('Berhasil Disalin')
                //     ->label('Total'),
                Tables\Columns\TextColumn::make('total_pp')
                    ->money('IDR')
                    ->searchable()
                    ->copyable()
                    ->sortable()
                    ->copyMessage('Berhasil Disalin')
                    ->label('Total Setelah Pajak'),
            ])
            ->poll('3s')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                DeleteAction::make()
                    ->icon('heroicon-o-trash')
                    ->before(function ($record) {
                        DB::table('penjualans')->where('kode', $record->kode_faktur)->delete();
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
                    }),
                Action::make('Cetak')
                    ->url(fn (Faktur $record): string => route('printfaktur', $record->kode_faktur))
                    ->icon('heroicon-o-printer')
                    ->color('warning')
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
            // 'edit' => Pages\EditFaktur::route('/{record}/edit'),
        ];
    }
}
