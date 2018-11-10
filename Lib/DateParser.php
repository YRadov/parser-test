<?php
/**
 * User: radov.yuriy@ukr.net
 * Date: 10.11.2018
 */

namespace Lib;


use Carbon\Carbon;
use Lib\Parsers\TimestampDateParser;

class DateParser implements IParser
{
    /**
     * @param mixed $date
     * @param null $format
     * @return int
     */
    public function parse($date, $format = null): int
    {
        $parser = $this->getDataTypeParser($date);
        return $this->parseDate($parser, $date);
    }

    private function parseDate(IDateParser $parser, $data): int
    {
        return $parser->parse($data);
    }

    private function getDataTypeParser($date)
    {
        $carbon = new Carbon($date);
        return (int)$carbon->format('Ymd');
        var_dump($carbon->format('Ymd'));die;
        return new TimestampDateParser();
        throw new \InvalidArgumentException();

    }
}// DateParser