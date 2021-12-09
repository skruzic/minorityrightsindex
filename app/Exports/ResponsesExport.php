<?php

namespace App\Exports;

use App\Models\Campaign;
use App\Models\Response;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ResponsesExport implements WithHeadings, FromCollection
{
    public function __construct(int $id)
    {
        $this->campaign = Campaign::findOrFail($id);
    }

    public function headings(): array
    {
        // TODO: Implement headings() method.
        return $this->campaign->leaves->pluck('code')->toArray();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = collect();

        $question_ids   = $this->campaign->leaves->pluck('id')->toArray();
        $question_codes = $this->campaign->leaves->pluck('code')->toArray();

        $groupedResponses = $this->campaign->responses->groupBy('invite_id')->toArray();

        foreach ($groupedResponses as $responses) {
            $rowData = array_pad([], count($question_ids), null);

            foreach ($responses as $response) {
                $key           = array_search($response['question_id'], $question_ids);
                $rowData[$key] = $response['answer'];
            }

            //$this->data[] = $rowData;
            $data->push($rowData);
        }

        return $data;
    }
}
