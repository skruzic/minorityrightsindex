<?php

namespace App\Filament\Resources\Campaigns\Pages;

use App\Filament\Resources\Campaigns\CampaignResource;
use App\Filament\Resources\Campaigns\Resources\Questions\QuestionResource;
use App\Models\Campaign;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Support\Icons\Heroicon;

class ManageQuestions extends ManageRelatedRecords
{
    protected static string $resource = CampaignResource::class;

    protected static string $relationship = 'allQuestions';

    protected static ?string $relatedResource = QuestionResource::class;

    protected static ?string $title = 'Questions';

    public function getHeaderActions(): array
    {
        /** @var Campaign $campaign */
        $campaign = $this->getRecord();

        return [
            Action::make('reorder')
                ->label('Reorder')
                ->icon(Heroicon::OutlinedArrowsUpDown)
                ->url(ReorderQuestions::getUrl(['record' => $campaign]))
                ->visible(fn (): bool => ! $campaign->locked),
            CreateAction::make()
                ->visible(fn (): bool => ! $campaign->locked),
        ];
    }
}
