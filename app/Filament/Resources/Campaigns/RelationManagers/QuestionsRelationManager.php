<?php

namespace App\Filament\Resources\Campaigns\RelationManagers;

use App\Filament\Resources\Campaigns\Resources\Questions\QuestionResource;
use App\Models\Campaign;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class QuestionsRelationManager extends RelationManager
{
    protected static string $relationship = 'allQuestions';

    protected static ?string $relatedResource = QuestionResource::class;

    protected static ?string $title = 'Questions';

    public function table(Table $table): Table
    {
        /** @var Campaign $campaign */
        $campaign = $this->getOwnerRecord();

        return $table
            ->headerActions([
                CreateAction::make()
                    ->visible(fn (): bool => ! $campaign->locked),
            ]);
    }
}
