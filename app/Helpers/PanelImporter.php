<?php
/**
 * Created by PhpStorm.
 * User: stanko
 * Date: 27.12.18.
 * Time: 14:16
 */

namespace App\Helpers;

use League\Csv\Reader;
use League\Csv\CharsetConverter;


class PanelImporter
{
    protected $header;

    protected $data;

    public function __construct($file)
    {
        $reader = Reader::createFromPath($file->getRealPath(), 'r');
        $reader->setHeaderOffset(0);
        $reader->setDelimiter(';');

        $this->header = $reader->getHeader();

        $records = $reader->getRecords();

        foreach ($records as $offset => $record) {
            $keys = array_keys($record);
            $values = array_values($record);

            //$questions[] = $values[0];
            //array_shift($values);
            $question = array_shift($values);

            $this->data[$question] = $values;
        }
    }

    public function import()
    {
        $table['header'] = $this->header;
        $table['body'] = $this->data;

        return $table;
    }
}