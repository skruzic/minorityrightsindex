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
        $question_ids   = $campaign->leaves->pluck('id')->toArray();
        $question_codes = $campaign->leaves->pluck('code')->toArray();

        $questions = array_combine($question_ids, $question_codes);

        $this->headers = $question_codes;

        // Grupiram po pozivnici da dobijem odgovore jednog ispitanika
        $groupedResponses = $campaign->responses->groupBy('invite_id')->toArray();


        foreach ($groupedResponses as $responses) {
            $rowData = array_pad([], count($question_ids), null);

            foreach ($responses as $response) {
                $key           = array_search($response['question_id'], $question_ids);
                $rowData[$key] = $response['answer'];
            }

            $this->data[] = $rowData;
        }
    }

    public function export()
    {
        $csv = Writer::createFromFileObject(new \SplTempFileObject());

        $csv->insertOne($this->headers);
        $csv->insertAll($this->data);

        $csv->setOutputBOM(Writer::BOM_UTF8);

        $csv->output('campaign.csv');
    }
}
