<?php
/**
 * User: radov.yuriy@ukr.net
 * Date: 10.11.2018
 */

namespace Lib;


class HB
{
    const TIMESTAMP_TYPE = 'timestamp';

    public function dtParse($date): int
    {
        if (is_array($date)) {
            return 19730407;
        }

        return (int)$date;
    }

    private function checkType($date)
    {

    }
}// HB