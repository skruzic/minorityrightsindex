<?php

namespace App\Filament\Resources\Campaigns\Resources\Invites\Pages;

use App\Filament\Resources\Campaigns\Resources\Invites\InviteResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditInvite extends EditRecord
{
    protected static string $resource = InviteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
