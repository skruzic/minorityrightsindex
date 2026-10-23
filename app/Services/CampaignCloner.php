<?php

namespace App\Services;

use App\Models\Campaign;

class CampaignCloner
{
    public function clone(Campaign $campaign): Campaign
    {
        $clone = $campaign->replicate();
        $clone->title = $campaign->title.' (clone)';
        $clone->push();

        foreach ($campaign->questions as $question) {
            $questionClone = $question->replicate();
            $clone->questions()->save($questionClone);

            foreach ($question->children as $child) {
                $childClone = $child->replicate();
                $childClone->parent_id = $questionClone->id;
                $questionClone->children()->save($childClone);
            }
        }

        return $clone;
    }
}
