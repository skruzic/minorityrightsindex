<?php

namespace App\Filament\Resources\Campaigns\Pages;

use App\Filament\Resources\Campaigns\CampaignResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCampaign extends CreateRecord
{
    protected static string $resource = CampaignResource::class;

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['messages'] = array_merge([
            'intro' => null,
            'final' => null,
            'email_before' => null,
            'email_after' => null,
        ], $data['messages'] ?? []);

        $data['locked'] = (bool) ($data['locked'] ?? false);

        return $data;
    }
}
