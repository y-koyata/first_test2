<?php

namespace App\Filament\Resources\CampaignResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use App\Exports\ReservationsExport;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Notifications\Notification;

class ReservationsRelationManager extends RelationManager
{
    protected static string $relationship = 'reservations';

    protected static ?string $title = '申し込み一覧';
    protected static ?string $modelLabel = '申し込み';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required(),
                // Add more fields if editing is required
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('氏名')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('メールアドレス')
                    ->searchable(),
                Tables\Columns\TextColumn::make('registered_at')
                    ->label('登録状態')
                    ->formatStateUsing(fn ($state) => $state ? '登録完了' : '仮登録')
                    ->badge()
                    ->color(fn ($state) => $state ? 'success' : 'warning')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('作成日時')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('completed')
                    ->label('登録完了のみ')
                    ->query(fn ($query) => $query->whereNotNull('registered_at')),
            ])
            ->headerActions([
                Tables\Actions\Action::make('export_csv')
                    ->label('CSVダウンロード')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function () {
                        return Excel::download(
                            new ReservationsExport($this->getOwnerRecord()),
                            'reservations-' . now()->format('Y-m-d') . '.csv',
                            \Maatwebsite\Excel\Excel::CSV
                        );
                    }),
                Tables\Actions\Action::make('export_excel')
                    ->label('EXCELダウンロード')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function () {
                        return Excel::download(
                            new ReservationsExport($this->getOwnerRecord()),
                            'reservations-' . now()->format('Y-m-d') . '.xlsx',
                            \Maatwebsite\Excel\Excel::XLSX
                        );
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
