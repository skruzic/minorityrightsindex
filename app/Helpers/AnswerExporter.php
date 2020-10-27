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


class AnswerExporter
{
    protected $headers;
    protected $data;

    public function __construct($id)
    {
        $campaign = Campaign::findOrFail($id);

        // ID pitanja iz kampanje
        $question_ids   = $campaign->questions->pluck('id');
        $question_codes = $campaign->questions->pluck('code');

        // Grupiram po pozivnici da dobijem odgovore jednog ispitanika
        $groupedResponses = $campaign->responses->groupBy('invite_id');
        //\Log::info(print_r($groupedResponses->toArray(), true));

        foreach ($groupedResponses as $responses) {

        }

        /*foreach ($models as $model) {
            $model_array = json_decode($model, true);
            $data        = json_decode($model_array['data'], true);
            foreach ($data as $key => $value) {
                if (is_array($value)) {
                    $flat       = implode(',', $value);
                    $data[$key] = $flat;
                }
            }
            $this->data[] = $data;
        }*/
    }

    public function export()
    {
        $csv = Writer::createFromFileObject(new \SplTempFileObject());

        $csv->insertOne($this->headers);
        $csv->insertAll($this->data);

        $csv->output('campaign.csv');
    }
}
