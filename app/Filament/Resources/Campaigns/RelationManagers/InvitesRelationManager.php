<?php

namespace App\Filament\Resources\Campaigns\RelationManagers;

use App\Filament\Resources\Campaigns\Resources\Invites\InviteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class InvitesRelationManager extends RelationManager
{
    protected static string $relationship = 'invites';

    protected static ?string $relatedResource = InviteResource::class;

    protected static ?string $title = 'Invites';

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
