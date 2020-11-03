<?php
/**
 * Created by PhpStorm.
 * User: stanko
 * Date: 27.01.19.
 * Time: 20:24
 */

namespace App\Helpers;

use App\Models\Campaign;
use League\Csv\Writer;


class CsvExporter
{
    protected $headers = [];
    protected $data = [];

    public function __construct($id)
    {
        $campaign = Campaign::findOrFail($id);

        // ID pitanja iz kampanje
        $question_ids   = $campaign->questions->pluck('id')->toArray();
        $question_codes = $campaign->questions->pluck('code')->toArray();

        //\Log::info(print_r($question_codes, true));

        $this->headers = $question_codes;

        // Grupiram po pozivnici da dobijem odgovore jednog ispitanika
        $groupedResponses = $campaign->responses->groupBy('invite_id')->toArray();
        //\Log::info(print_r($groupedResponses->toArray(), true));


        foreach ($groupedResponses as $responses) {
            $rowData = [];
            foreach ($responses as $response) {
                if (in_array($response['question_id'], $question_ids)) {
                    $rowData[] = $response['answer'];
                }
            }
            $this->data[] = $rowData;
        }
    }

    public function export()
    {
        $csv = Writer::createFromFileObject(new \SplTempFileObject());

        $csv->insertOne($this->headers);
        $csv->insertAll($this->data);

        $csv->output('campaign.csv');
    }
}
