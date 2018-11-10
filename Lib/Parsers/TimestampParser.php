<?php
/**
 * User: radov.yuriy@ukr.net
 * Date: 10.11.2018
 */

namespace Lib\Parsers;


use Lib\IParser;

class TimestampParser implements IParser
{
    public function parse($timestamp): int
    {
        $date = new \DateTime("@$timestamp");
        return $date->format('Ymd');
    }
}// Timestamp