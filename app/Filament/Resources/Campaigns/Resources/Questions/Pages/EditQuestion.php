<?php

namespace App\Filament\Resources\Campaigns\Resources\Questions\Pages;

use App\Filament\Resources\Campaigns\Resources\Questions\QuestionResource;
use App\Models\Question;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditQuestion extends EditRecord
{
    protected static string $resource = QuestionResource::class;

    public function mount(int|string $record): void
    {
        parent::mount($record);

        /** @var Question $question */
        $question = $this->getRecord();

        abort_if($question->campaign?->locked, 403);
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->visible(fn (): bool => ! $this->getRecord()->campaign?->locked),
        ];
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['parent_id'] = $data['parent_id'] ?? 0;
        $data['conditions'] = $data['conditions'] ?? [];

        return $data;
    }
}
