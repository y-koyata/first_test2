<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CampaignResource\Pages;
use App\Models\Campaign;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Pages\Page;

class CampaignResource extends Resource
{
    protected static ?string $model = Campaign::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $modelLabel = 'イベント';
    protected static ?string $navigationLabel = 'イベント管理';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('基本情報')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('イベント名')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->label('URL用スラッグ')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('image_path')
                            ->label('メイン画像')
                            ->image()
                            ->directory('campaign_images')
                            ->columnSpanFull(),
                        Forms\Components\Select::make('status')
                            ->label('ステータス')
                            ->options([
                                'draft' => '下書き',
                                'open' => '受付中',
                                'closed' => '受付終了',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('template_file')
                            ->label('テンプレートファイル')
                            ->placeholder('campaign.index')
                            ->helperText('例: campaign.events.special_event (resources/views/campaign/events/special_event.blade.php の場合)'),
                    ])->columns(2),

                Forms\Components\Section::make('開催日時・受付期間')
                    ->schema([
                        Forms\Components\DateTimePicker::make('event_date')
                            ->label('イベント開催日時')
                            ->required(),
                        Forms\Components\DateTimePicker::make('application_start_at')
                            ->label('申し込み開始日時')
                            ->required(),
                        Forms\Components\DateTimePicker::make('application_end_at')
                            ->label('申し込み終了日時')
                            ->required(),
                        Forms\Components\DatePicker::make('document_request_deadline')
                            ->label('資料請求締切日'),
                        Forms\Components\DatePicker::make('postal_application_deadline')
                            ->label('郵送申し込み締切日'),
                        Forms\Components\DatePicker::make('payment_deadline')
                            ->label('入金締切日'),
                        Forms\Components\DatePicker::make('confirmation_delivery_date')
                            ->label('受理票発送期限（到着目安）'),
                    ])->columns(3),

                Forms\Components\Section::make('料金設定')
                    ->schema([
                        Forms\Components\TextInput::make('base_fee')
                            ->label('基本参加料')
                            ->numeric()
                            ->required()
                            ->prefix('¥'),
                        Forms\Components\TextInput::make('companion_adult_fee')
                            ->label('同伴者（大人）')
                            ->numeric()
                            ->required()
                            ->prefix('¥'),
                        Forms\Components\TextInput::make('companion_child_fee')
                            ->label('同伴者（子供）')
                            ->numeric()
                            ->required()
                            ->prefix('¥'),
                        Forms\Components\TextInput::make('additional_parking_fee')
                            ->label('追加駐車台数')
                            ->numeric()
                            ->required()
                            ->prefix('¥'),
                    ])->columns(4),

                Forms\Components\Section::make('アンケート定義')
                    ->schema([
                        Forms\Components\Repeater::make('survey_definition')
                            ->label('アンケート項目')
                            ->schema([
                                Forms\Components\TextInput::make('label')
                                    ->label('質問タイトル')
                                    ->required(),
                                Forms\Components\Select::make('type')
                                    ->label('形式')
                                    ->options([
                                        'text' => '短文テキスト',
                                        'textarea' => '長文テキスト',
                                        'select' => 'プルダウン',
                                        'radio' => 'ラジオボタン',
                                        'checkbox' => 'チェックボックス',
                                    ])
                                    ->required()
                                    ->live(),
                                Forms\Components\TagsInput::make('options')
                                    ->label('選択肢（Enterで追加）')
                                    ->placeholder('選択肢1, 選択肢2...')
                                    ->visible(fn (Forms\Get $get) => in_array($get('type'), ['select', 'radio', 'checkbox'])),
                                Forms\Components\Toggle::make('is_required')
                                    ->label('必須')
                                    ->default(false),
                                Forms\Components\Textarea::make('remarks')
                                    ->label('補足説明・備考'),
                            ])
                            ->columns(2)
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('status')
                    ->label('ステータス')
                    ->badge()
                    ->getStateUsing(function (Campaign $record): string {
                        if ($record->status === 'draft') {
                            return '下書き';
                        }
                        if ($record->status === 'closed') {
                            return '終了';
                        }
                        // status is open
                        $now = now();
                        if ($now < $record->application_start_at || $now > $record->application_end_at) {
                             if ($now > $record->application_end_at) {
                                 return '終了';
                             }
                             return '非公開（申し込み期間外）';
                        }
                        return '受付中';
                    })
                    ->colors([
                        'gray' => '下書き',
                        'warning' => '非公開（申し込み期間外）',
                        'success' => '受付中',
                        'danger' => '終了',
                    ]),
                Tables\Columns\TextColumn::make('name')
                    ->label('イベント名')
                    ->searchable(),
                Tables\Columns\TextColumn::make('event_date')
                    ->label('開催日時')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('application_period')
                    ->label('受付期間')
                    ->getStateUsing(fn (Campaign $record) => $record->application_start_at->format('m/d H:i') . ' ~ ' . $record->application_end_at->format('m/d H:i')),
                Tables\Columns\TextColumn::make('reservations_count')
                    ->counts('reservations')
                    ->label('申し込み人数'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('view_applications')
                    ->label('申し込み情報')
                    ->icon('heroicon-o-users')
                    ->url(fn (Campaign $record): string => CampaignResource::getUrl('reservations', ['record' => $record])),
                Tables\Actions\Action::make('view_event')
                    ->label('イベントページ')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->url(fn (Campaign $record): string => route('campaign.index', ['slug' => $record->slug]))
                    ->openUrlInNewTab(),
                Tables\Actions\Action::make('preview_event')
                    ->label('プレビュー')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Campaign $record): string => route('campaign.preview', ['slug' => $record->slug]))
                    ->openUrlInNewTab(),
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
            // RelationManagers\ReservationsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCampaigns::route('/'),
            'create' => Pages\CreateCampaign::route('/create'),
            'edit' => Pages\EditCampaign::route('/{record}/edit'),
            'reservations' => Pages\ManageReservations::route('/{record}/reservations'),
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\EditCampaign::class,
            Pages\ManageReservations::class,
        ]);
    }
}
