<?php

namespace App\Filament\Resources;

use stdClass;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Pages\Page;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\DeleteAction;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\Pages\EditUser;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use App\Filament\Resources\UserResource\Pages\CreateUser;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Kelola Pengguna';
    protected static ?string $navigationGroup = 'Admin';
    public static ?string $label = 'Kelola Pengguna';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([

                    TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Masukkan Nama Kamu'),
                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Masukkan Email')
                        ->unique(ignoreRecord: true),
                    TextInput::make('password')
                        ->password()
                        ->dehydrateStateUsing(static fn (null|string $state): null|string => filled($state) ? Hash::make($state) : null)
                        ->required(static fn (Page $livewire): string => $livewire instanceof CreateUser,)
                        ->dehydrated(static fn (null|string $state): bool => filled($state))
                        ->label(
                            static fn (Page $livewire): string => ($livewire instanceof EditUser) ? 'Ganti Password' : 'Masukkan Password'
                        ),
                    Select::make('roles')
                        ->multiple()
                        ->relationship('roles', 'name')
                        ->preload(),
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
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Berhasil Disalin')
                    ->sortable()
                    ->label('Nama'),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Berhasil Disalin')
                    ->sortable()
                    ->label('Email'),
                TextColumn::make('roles.name')
                    ->label('Role')
                    ->copyable()
                    ->copyMessage('Berhasil Disalin')
                    ->sortable(),
            ])
            ->poll('3s')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
