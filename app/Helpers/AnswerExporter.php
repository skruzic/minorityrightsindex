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
    public function __construct()
    {
        $id = 1;
        $model = Answer::whereCampaignId($id)->get();

        \Log::info($model);
    }
}