<?php
/**
 * User: radov.yuriy@ukr.net
 * Date: 10.11.2018
 */

namespace Lib;


use Lib\Parsers\TimestampDateParser;

class DateParser implements IParser
{
    const TIMESTAMP_TYPE = 'timestamp';

    /**
     * @var string
     */
    private $type;


    /**
     * @param mixed $date
     * @return int
     */
    public function parse($date): int
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
        return new TimestampDateParser();
        throw new \InvalidArgumentException();

    }
}// DateParser