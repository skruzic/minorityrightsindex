<?php

namespace App\Filament\Resources\Campaigns;

use App\Exports\ResponsesExport;
use App\Filament\Resources\Campaigns\Pages\CreateCampaign;
use App\Filament\Resources\Campaigns\Pages\EditCampaign;
use App\Filament\Resources\Campaigns\Pages\ListCampaigns;
use App\Filament\Resources\Campaigns\Pages\ManageInvites;
use App\Filament\Resources\Campaigns\Pages\ManageQuestions;
use App\Filament\Resources\Campaigns\Pages\ReorderQuestions;
use App\Models\Campaign;
use App\Services\CampaignCloner;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Maatwebsite\Excel\Facades\Excel;

class CampaignResource extends Resource
{
    protected static ?string $model = Campaign::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Campaigns';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Campaign')
                    ->tabs([
                        Tab::make('General')
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('slug')
                                    ->hint('If left empty, it will be generated automatically')
                                    ->maxLength(255),
                                Textarea::make('description')
                                    ->columnSpanFull(),
                                Checkbox::make('locked')
                                    ->label('Lock the campaign')
                                    ->helperText('When the campaign is locked, no new questions can be created and it can be filled by users'),
                            ]),
                        Tab::make('Messages')
                            ->schema([
                                RichEditor::make('messages.intro')
                                    ->label('Introductory message')
                                    ->helperText('If set, the message is displayed as the first page of the survey.')
                                    ->columnSpanFull(),
                                RichEditor::make('messages.final')
                                    ->label('Final message')
                                    ->helperText('If set, the message is displayed as the last page of the survey. Otherwise, a generic thank-you message is displayed.')
                                    ->columnSpanFull(),
                                RichEditor::make('messages.email_before')
                                    ->label('E-mail: text before the link to the survey')
                                    ->helperText('The message is displayed at the beginning of the invitation e-mail.')
                                    ->columnSpanFull(),
                                RichEditor::make('messages.email_after')
                                    ->label('E-mail: text after the link to the survey')
                                    ->helperText('The message is displayed after the link to the survey in the invitation e-mail.')
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->defaultSort('updated_at', 'desc')
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->url(fn (Campaign $record): string => ManageQuestions::getUrl(['record' => $record])),
                IconColumn::make('locked')
                    ->boolean(),
                TextColumn::make('updated_at')
                    ->label('Last update')
                    ->dateTime()
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('questions')
                    ->label('Questions')
                    ->icon(Heroicon::OutlinedListBullet)
                    ->url(fn (Campaign $record): string => ManageQuestions::getUrl(['record' => $record])),
                Action::make('invites')
                    ->label('Invites')
                    ->icon(Heroicon::OutlinedEnvelope)
                    ->url(fn (Campaign $record): string => ManageInvites::getUrl(['record' => $record])),
                Action::make('clone')
                    ->label('Clone')
                    ->icon(Heroicon::OutlinedDocumentDuplicate)
                    ->requiresConfirmation()
                    ->action(function (Campaign $record): void {
                        app(CampaignCloner::class)->clone($record);

                        Notification::make()
                            ->title('Campaign cloned')
                            ->success()
                            ->send();
                    }),
                Action::make('toggleLock')
                    ->label(fn (Campaign $record): string => $record->locked ? 'Unlock' : 'Lock')
                    ->icon(fn (Campaign $record) => $record->locked ? Heroicon::OutlinedLockOpen : Heroicon::OutlinedLockClosed)
                    ->action(function (Campaign $record): void {
                        $record->locked = ! $record->locked;
                        $record->save();

                        Notification::make()
                            ->title($record->locked ? 'Campaign locked' : 'Campaign unlocked')
                            ->success()
                            ->send();
                    }),
                Action::make('download')
                    ->label('Export')
                    ->icon(Heroicon::OutlinedArrowDownTray)
                    ->action(fn (Campaign $record) => Excel::download(
                        new ResponsesExport($record->id),
                        'data.xlsx'
                    )),
                Action::make('preview')
                    ->label('Preview')
                    ->icon(Heroicon::OutlinedEye)
                    ->url(
                        fn (Campaign $record): string => url('/campaign/preview/'.$record->slug),
                        shouldOpenInNewTab: true,
                    )
                    ->visible(fn (Campaign $record): bool => ! $record->locked),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\QuestionsRelationManager::class,
            RelationManagers\InvitesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCampaigns::route('/'),
            'create' => CreateCampaign::route('/create'),
            'edit' => EditCampaign::route('/{record}/edit'),
            'questions' => ManageQuestions::route('/{record}/questions'),
            'questions.reorder' => ReorderQuestions::route('/{record}/questions/reorder'),
            'invites' => ManageInvites::route('/{record}/invites'),
        ];
    }
}
