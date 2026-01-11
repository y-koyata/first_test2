<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservationResource\Pages;
use App\Models\Reservation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $modelLabel = '申し込み';
    protected static ?string $navigationLabel = '申し込み一覧';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('campaign_id')
                    ->relationship('campaign', 'name')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('status')
                    ->options([
                        'temporary' => 'temporary',
                        'paid' => 'paid',
                    ])
                    ->required(),
                Forms\Components\Section::make('基本情報')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('name_kana')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('tel')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('zip_code')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('address')
                            ->required()
                            ->maxLength(255),
                    ])->columns(2),
                Forms\Components\Section::make('車両情報')
                    ->schema([
                        Forms\Components\TextInput::make('car_model')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('car_year')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('car_registration_no')
                            ->required()
                            ->maxLength(255),
                    ])->columns(3),
                Forms\Components\Section::make('申込内容')
                    ->schema([
                        Forms\Components\TextInput::make('companion_adult_count')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('companion_child_count')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('additional_parking_count')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Forms\Components\DatePicker::make('transfer_date')
                            ->required(),
                        Forms\Components\TextInput::make('total_amount')
                            ->required()
                            ->numeric()
                            ->prefix('¥'),
                    ])->columns(3),
                Forms\Components\Section::make('アンケート回答')
                    ->schema([
                        Forms\Components\KeyValue::make('survey_data')
                            ->label('アンケートデータ')
                            ->keyLabel('項目')
                            ->valueLabel('回答'),
                    ]),
                Forms\Components\DateTimePicker::make('email_verified_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('campaign.name')
                    ->label('イベント')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('氏名')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('ステータス')
                    ->badge()
                    ->colors([
                        'gray' => 'temporary',
                        'success' => 'paid',
                    ]),
                Tables\Columns\TextColumn::make('total_amount')
                    ->label('合計金額')
                    ->money('jpy')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('campaign')
                    ->relationship('campaign', 'name'),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'temporary' => 'temporary',
                        'paid' => 'paid',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListReservations::route('/'),
            'create' => Pages\CreateReservation::route('/create'),
            'edit' => Pages\EditReservation::route('/{record}/edit'),
        ];
    }
}
