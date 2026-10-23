<?php

namespace App\Services;

use App\Models\Question;
use Illuminate\Support\Facades\DB;

class QuestionTree
{
    /**
     * Rebuild lft/rgt for a campaign from parent_id and current sibling order.
     */
    public function rebuild(int $campaignId): void
    {
        $roots = Question::query()
            ->where('campaign_id', $campaignId)
            ->where(function ($query) {
                $query->where('parent_id', 0)->orWhereNull('parent_id');
            })
            ->orderBy('lft')
            ->get();

        DB::transaction(function () use ($roots) {
            $lft = 1;

            foreach ($roots as $root) {
                $children = Question::query()
                    ->where('parent_id', $root->id)
                    ->orderBy('lft')
                    ->get();

                $root->lft = $lft++;

                if ($children->isEmpty()) {
                    $root->rgt = $lft++;
                } else {
                    foreach ($children as $child) {
                        $child->lft = $lft++;
                        $child->rgt = $lft++;
                        $child->saveQuietly();
                    }

                    $root->rgt = $lft++;
                }

                $root->saveQuietly();
            }
        });
    }

    /**
     * Move a question among its siblings by delta (-1 or +1), then rebuild.
     */
    public function move(Question $question, int $delta): void
    {
        $parentId = $question->parent_id ?: 0;

        $siblings = Question::query()
            ->where('campaign_id', $question->campaign_id)
            ->where(function ($query) use ($parentId) {
                if ($parentId === 0) {
                    $query->where('parent_id', 0)->orWhereNull('parent_id');
                } else {
                    $query->where('parent_id', $parentId);
                }
            })
            ->orderBy('lft')
            ->get()
            ->values();

        $index = $siblings->search(fn (Question $sibling) => $sibling->id === $question->id);

        if ($index === false) {
            return;
        }

        $swapWith = $index + $delta;

        if ($swapWith < 0 || $swapWith >= $siblings->count()) {
            return;
        }

        $current = $siblings[$index];
        $other = $siblings[$swapWith];

        $currentLft = $current->lft;
        $current->lft = $other->lft;
        $other->lft = $currentLft;
        $current->saveQuietly();
        $other->saveQuietly();

        $this->rebuild((int) $question->campaign_id);
    }
}
