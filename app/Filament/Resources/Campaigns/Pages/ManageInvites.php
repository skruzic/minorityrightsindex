<?php

namespace App\Filament\Resources\Campaigns\Pages;

use App\Filament\Resources\Campaigns\CampaignResource;
use App\Filament\Resources\Campaigns\Resources\Invites\InviteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRelatedRecords;

class ManageInvites extends ManageRelatedRecords
{
    protected static string $resource = CampaignResource::class;

    protected static string $relationship = 'invites';

    protected static ?string $relatedResource = InviteResource::class;

    protected static ?string $title = 'Invites';

    public function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
