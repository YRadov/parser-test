<?php
/**
 * User: radov.yuriy@ukr.net
 * Date: 10.11.2018
 */

namespace Lib\Parsers;


use Lib\IDateParser;

class TimestampDateParser implements IDateParser
{
    public function parse($timestamp): int
    {
        if (!is_int($timestamp)) {
            throw new \InvalidArgumentException(__CLASS__ . '::' . __METHOD__);
        }
        $date = new \DateTime("@$timestamp");
        return $date->format('Ymd');
    }
}// Timestamp