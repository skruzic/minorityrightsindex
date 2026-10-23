<?php

namespace App\Filament\Resources\Campaigns\Resources\Invites\Pages;

use App\Filament\Resources\Campaigns\Resources\Invites\InviteResource;
use App\Models\Campaign;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateInvite extends CreateRecord
{
    protected static string $resource = InviteResource::class;

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

        $data['token'] = $data['token'] ?? Str::random(36);

        return $data;
    }
}
