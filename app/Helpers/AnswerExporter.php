<?php
/**
 * Created by PhpStorm.
 * User: stanko
 * Date: 27.01.19.
 * Time: 20:24
 */

namespace App\Helpers;

use App\Models\Answer;
use League\Csv\Writer;


class AnswerExporter
{
    protected $headers;
    protected $data;

    public function __construct($id)
    {
        //$id = 1;
        $models = Answer::whereCampaignId($id)->get();

        // Vadim header
        $this->headers = array_keys(json_decode(json_decode($models[0], true)['data'], true));

        foreach ($models as $model) {
            $model_array = json_decode($model, true);
            $data        = json_decode($model_array['data'], true);
            foreach ($data as $key => $value) {
                if (is_array($value)) {
                    $flat = implode(',', $value);
                    $data[$key] = $flat;
                }
            }
            $this->data[] = $data;
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