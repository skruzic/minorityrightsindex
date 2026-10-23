<?php

namespace App\Filament\Resources\Campaigns\Resources\Questions\Pages;

use App\Filament\Resources\Campaigns\Resources\Questions\QuestionResource;
use App\Models\Campaign;
use Filament\Resources\Pages\CreateRecord;

class CreateQuestion extends CreateRecord
{
    protected static string $resource = QuestionResource::class;

    public function mount(): void
    {
        parent::mount();

        $parent = $this->getParentRecord();

        abort_if($parent instanceof Campaign && $parent->locked, 403);
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $parent = $this->getParentRecord();

        if ($parent instanceof Campaign) {
            $data['campaign_id'] = $parent->id;
        }

        $data['parent_id'] = $data['parent_id'] ?? 0;
        $data['conditions'] = $data['conditions'] ?? [];

        return $data;
    }
}
