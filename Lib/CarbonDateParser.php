<?php
/**
 * User: radov.yuriy@ukr.net
 * Date: 10.11.2018
 */

namespace Lib;


use Carbon\Carbon;

class CarbonDateParser implements IParser
{
    /**
     * @param mixed $date
     * @return int
     */
    public function parse($date): int
    {
        $carbon = new Carbon($date);
        return (int)$carbon->format('Ymd');

        $parser = $this->getDataTypeParser($date);
        return $this->parseDate($parser, $date);
    }

    private function parseDate(IDateParser $parser, $data): int
    {
        return $parser->parse($data);
    }

    private function getDataTypeParser($date)
    {
        return new TimestampDateParser();
        throw new \InvalidArgumentException();

    }

}// CarbonDateParser