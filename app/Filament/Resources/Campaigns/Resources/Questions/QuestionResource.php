<?php

namespace App\Filament\Resources\Campaigns\Resources\Questions;

use App\Enums\QuestionType;
use App\Filament\Resources\Campaigns\CampaignResource;
use App\Filament\Resources\Campaigns\Resources\Questions\Pages\CreateQuestion;
use App\Filament\Resources\Campaigns\Resources\Questions\Pages\EditQuestion;
use App\Models\Campaign;
use App\Models\OptionGroup;
use App\Models\Question;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedListBullet;

    protected static ?string $parentResource = CampaignResource::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $recordTitleAttribute = 'text';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Question')
                    ->tabs([
                        Tab::make('General')
                            ->schema([
                                TextInput::make('code')
                                    ->label('Code')
                                    ->helperText('Identification code and CSV column name for this question. Should be unique in the campaign. Can contain only alphanumeric characters, dashes and underscores.')
                                    ->required()
                                    ->regex('/^[A-Za-z0-9_-]+$/'),
                                Textarea::make('text')
                                    ->label('Question text')
                                    ->required()
                                    ->columnSpanFull(),
                                Select::make('type')
                                    ->label('Type')
                                    ->options(QuestionType::asSelectArray())
                                    ->required()
                                    ->native(false),
                                Select::make('option_group_id')
                                    ->label('Options')
                                    ->options(fn (): array => OptionGroup::query()->orderBy('name')->pluck('name', 'id')->all())
                                    ->searchable()
                                    ->nullable(),
                                Select::make('parent_id')
                                    ->label('Parent question')
                                    ->helperText('Leave as top-level unless this is a Likert row under another question.')
                                    ->options(function (?Model $record, $get, $livewire): array {
                                        $campaignId = static::resolveCampaignId($livewire, $record);

                                        if (! $campaignId) {
                                            return [];
                                        }

                                        return Question::query()
                                            ->where('campaign_id', $campaignId)
                                            ->when($record, fn (Builder $query) => $query->whereKeyNot($record->getKey()))
                                            ->where(function (Builder $query) {
                                                $query->where('parent_id', 0)->orWhereNull('parent_id');
                                            })
                                            ->orderBy('lft')
                                            ->pluck('text', 'id')
                                            ->all();
                                    })
                                    ->searchable()
                                    ->nullable()
                                    ->dehydrated()
                                    ->dehydrateStateUsing(fn ($state) => $state ?: 0),
                                Hidden::make('campaign_id')
                                    ->default(fn ($livewire) => static::resolveCampaignId($livewire))
                                    ->dehydrated(),
                            ]),
                        Tab::make('Conditionals')
                            ->schema([
                                Repeater::make('conditions')
                                    ->schema([
                                        TextInput::make('answer')
                                            ->label('Answer')
                                            ->required(),
                                        Select::make('question_id')
                                            ->label('Question')
                                            ->options(function (?Model $record, $livewire): array {
                                                $campaignId = static::resolveCampaignId($livewire, $record);

                                                if (! $campaignId) {
                                                    return [];
                                                }

                                                return Question::query()
                                                    ->where('campaign_id', $campaignId)
                                                    ->orderBy('lft')
                                                    ->pluck('text', 'id')
                                                    ->all();
                                            })
                                            ->searchable()
                                            ->required(),
                                    ])
                                    ->default([])
                                    ->columns(2)
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('text')
            ->defaultSort('lft')
            ->defaultPaginationPageOption(50)
            ->columns([
                TextColumn::make('code')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('text')
                    ->limit(60)
                    ->searchable(),
                TextColumn::make('type')
                    ->formatStateUsing(fn ($state): string => QuestionType::tryFrom((int) $state)?->label() ?? (string) $state),
                TextColumn::make('optiongroup.name')
                    ->label('Options')
                    ->toggleable(),
                IconColumn::make('conditions')
                    ->label('Condition')
                    ->boolean()
                    ->getStateUsing(fn (Question $record): bool => ! empty($record->conditions)),
                TextColumn::make('parent_id')
                    ->label('Parent')
                    ->formatStateUsing(fn ($state): string => ((int) $state) > 0 ? (string) $state : '—')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->recordActions([
                EditAction::make()
                    ->visible(fn (Question $record): bool => ! $record->campaign?->locked),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->visible(fn ($livewire): bool => ! static::campaignIsLocked($livewire)),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'create' => CreateQuestion::route('/create'),
            'edit' => EditQuestion::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return true;
    }

    protected static function resolveCampaignId($livewire, ?Model $record = null): ?int
    {
        if ($record instanceof Question) {
            return (int) $record->campaign_id;
        }

        if (isset($livewire->ownerRecord) && $livewire->ownerRecord instanceof Campaign) {
            return (int) $livewire->ownerRecord->id;
        }

        if (isset($livewire->record) && $livewire->record instanceof Campaign) {
            return (int) $livewire->record->id;
        }

        if (isset($livewire->getOwnerRecord) && is_callable([$livewire, 'getOwnerRecord'])) {
            $owner = $livewire->getOwnerRecord();

            if ($owner instanceof Campaign) {
                return (int) $owner->id;
            }
        }

        return null;
    }

    protected static function campaignIsLocked($livewire): bool
    {
        $campaignId = static::resolveCampaignId($livewire);

        if (! $campaignId) {
            return false;
        }

        return (bool) Campaign::query()->whereKey($campaignId)->value('locked');
    }
}
