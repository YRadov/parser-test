<?php
/**
 * User: radov.yuriy@ukr.net
 * Date: 10.11.2018
 */

namespace Lib;


use Carbon\Carbon;

class CarbonDateParser extends DateParser
{
    /**
     * @param mixed $date
     * @param mixed $format
     * @return int
     */
    public function parse($date, $format = null): int
    {
        $date = $this->prepareDate($date, $format);
        try {
            $carbon = new Carbon($date);
        } catch (\Exception $e) {
            $carbon = $this->tryCreateFromExtraFormats($date);
        }
        $result = $carbon->format('Ymd');
        if ($this->dateWithoutDays($date)) {
            $result = $this->removeDays($result);
        } else {
            /**
             * There are two wrong day numbers
             * Friday, Jul 4 1973
             * Fri, July 4 1973
             * it was July 6 or Wednesday 4
             * change result as in received string
             */
            $result = $this->makeWrongDay($date, $result);
        }
        if ($this->dateWithoutMonth($date)) {
            $result = $this->removeMonth($result);
        }
        return (int)$result;
    }
}// CarbonDateParser