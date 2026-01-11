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

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('campaign_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('name_kana')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('gender')
                    ->options([
                        1 => '男',
                        2 => '女',
                    ])
                    ->required(),
                Forms\Components\DatePicker::make('birth_date')
                    ->required(),
                Forms\Components\TextInput::make('zip_code')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('tel')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('mtb_experience')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('club_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('club_base')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('club_role')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('car_model')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('car_year')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('car_color')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('car_color_other')
                    ->maxLength(255),
                Forms\Components\TextInput::make('car_registration_no')
                    ->required()
                    ->maxLength(255),
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
                Forms\Components\DatePicker::make('application_date')
                    ->required(),
                Forms\Components\TextInput::make('total_amount')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('status')
                    ->options([
                        'temporary' => 'temporary',
                        'pending' => 'pending',
                        'paid' => 'paid',
                    ])
                    ->required(),
                Forms\Components\DateTimePicker::make('email_verified_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('campaign_id')->sortable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'temporary' => 'gray',
                        'pending' => 'warning',
                        'paid' => 'success',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('application_date')->date()->sortable(),
                Tables\Columns\TextColumn::make('total_amount')->money('jpy')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'temporary' => 'temporary',
                        'pending' => 'pending',
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
