<?php

namespace App\Exports;

use App\Models\Campaign;
use Illuminate\Support\Enumerable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ResponsesExport implements WithHeadings, FromCollection
{
    protected Campaign $campaign;

    public function __construct(int $id)
    {
        $this->campaign = Campaign::findOrFail($id);
    }

    public function headings(): array
    {
        return $this->campaign->leaves->pluck('code')->toArray();
    }

    public function collection(): Enumerable
    {
        $data = collect();

        $question_ids = $this->campaign->leaves->pluck('id')->toArray();

        $groupedResponses = $this->campaign->responses->groupBy('invite_id')->toArray();

        foreach ($groupedResponses as $responses) {
            $rowData = array_pad([], count($question_ids), null);

            foreach ($responses as $response) {
                $key = array_search($response['question_id'], $question_ids);
                $rowData[$key] = $response['answer'];
            }

            $data->push($rowData);
        }

        return $data;
    }
}
