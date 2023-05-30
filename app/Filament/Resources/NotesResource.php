<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Notes;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\NotesResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\NotesResource\RelationManagers;
use Filament\Tables\Actions\DeleteAction;

class NotesResource extends Resource
{
    protected static ?string $model = Notes::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil';
    protected static ?string $navigationGroup = 'Pendataan';
    protected static ?string $navigationLabel = 'Catatan';
    protected static ?int $navigationSort = 13;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make('judul'),
                    DatePicker::make('tanggal'),
                    RichEditor::make('isi'),
                    Hidden::make('user_id')
                        ->default(Auth::user()->id),
                ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Grid::make([
                    'lg' => 1,
                    '2xl' => 1,
                ])->schema([
                    Split::make([
                            Stack::make([
                                TextColumn::make('judul')
                                    ->copyable()
                                    ->copyMessage('Berhasil Disalin')
                                    ->searchable(),
                                TextColumn::make('tanggal')
                                    ->copyable()
                                    ->copyMessage('Berhasil Disalin')
                                    ->icon('heroicon-s-calendar')
                                    ->date(),
                                    TextColumn::make('isi')
                                        ->html(),
                                    TextColumn::make('user.name')
                                        ->copyable()
                                        ->icon('heroicon-s-user')
                                        ->copyMessage('Berhasil Disalin')
                                        ->label('Pembuat'),
                            ])->space(2),
                      
                    ])
                ])
            ])
            ->filters([
                Filter::make('judul')->label('Judul')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make()
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
            'index' => Pages\ListNotes::route('/'),
            'create' => Pages\CreateNotes::route('/create'),
            'edit' => Pages\EditNotes::route('/{record}/edit'),
        ];
    }
}
