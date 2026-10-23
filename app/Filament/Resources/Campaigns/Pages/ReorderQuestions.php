<?php

namespace App\Filament\Resources\Campaigns\Pages;

use App\Filament\Resources\Campaigns\CampaignResource;
use App\Models\Campaign;
use App\Models\Question;
use App\Services\QuestionTree;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Livewire\Attributes\Computed;

/**
 * @property-read Campaign $record
 */
class ReorderQuestions extends Page
{
    protected static string $resource = CampaignResource::class;

    protected static ?string $title = 'Reorder questions';

    protected string $view = 'filament.resources.campaigns.pages.reorder-questions';

    public Campaign $record;

    public function mount(int|string $record): void
    {
        $this->record = Campaign::query()->findOrFail($record);

        abort_if($this->record->locked, 403);
    }

    public function getHeading(): string|Htmlable
    {
        return 'Reorder questions: '.$this->record->title;
    }

    public function getBreadcrumbs(): array
    {
        return [
            CampaignResource::getUrl() => 'Campaigns',
            ManageQuestions::getUrl(['record' => $this->record]) => 'Questions',
            'Reorder',
        ];
    }

    /**
     * @return list<Question>
     */
    #[Computed]
    public function questions(): array
    {
        return $this->record->allQuestions()->get()->all();
    }

    public function moveUp(int $questionId): void
    {
        $this->move($questionId, -1);
    }

    public function moveDown(int $questionId): void
    {
        $this->move($questionId, 1);
    }

    protected function move(int $questionId, int $delta): void
    {
        abort_if($this->record->locked, 403);

        $question = Question::query()
            ->where('campaign_id', $this->record->id)
            ->whereKey($questionId)
            ->firstOrFail();

        app(QuestionTree::class)->move($question, $delta);

        unset($this->questions);

        Notification::make()
            ->title('Question order updated')
            ->success()
            ->send();
    }

    public function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label('Back to questions')
                ->icon(Heroicon::OutlinedArrowLeft)
                ->url(ManageQuestions::getUrl(['record' => $this->record])),
        ];
    }
}
