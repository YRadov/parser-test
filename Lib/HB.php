<?php
/**
 * User: radov.yuriy@ukr.net
 * Date: 10.11.2018
 */

namespace Lib;


use Lib\Parsers\TimestampParser;

class HB
{
    const TIMESTAMP_TYPE = 'timestamp';

    /**
     * @var DateParser
     */
    private $dateParser;

    /**
     * HB constructor.
     * @param $dateParser
     */
    public function __construct(DateParser $dateParser)
    {
        $this->dateParser = $dateParser;
    }

    public function dtParse($date): int
    {
        $type = $this->checkType($date);
        return $this->getFormatDate($type, $date);
    }

    private function checkType($date)
    {
        return self::TIMESTAMP_TYPE;
    }

    /**
     * @param string $type
     * @param mixed $date
     * @return int
     */
    private function getFormatDate($type, $date)
    {
        switch ($type) {
            case self::TIMESTAMP_TYPE:
                return $this->dateParser->parse(new TimestampParser(), $date);
        }

        throw new \InvalidArgumentException();
    }
}// HB