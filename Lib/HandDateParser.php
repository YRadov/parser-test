<?php
/**
 * User: radov.yuriy@ukr.net
 * Date: 10.11.2018
 */

namespace Lib;


class HandDateParser extends DateParser
{
    /**
     * @param mixed $date
     * @param null $format
     * @return int
     */
    public function parse($date, $format = null): int
    {
        return 1;
    }
}// DateParser