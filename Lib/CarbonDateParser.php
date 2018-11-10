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
     * @param mixed $format
     * @return int
     */
    public function parse($date, $format = null): int
    {
        $date = $this->prepareDate($date, $format);
        $carbon = new Carbon($date);
        return (int)$carbon->format('Ymd');
    }

    private function prepareDate($date, $format)
    {
        if (is_int($date)) {
            return $date;
        }
        if (isset($format)) {
            return $this->prepareWithFormat($date, $format);
        }
        $date = $this->checkDateString($date);
        return $date;
    }

    /**
     * @param string $date - e.g. ['07/04/1973', ['dmy' => 1]]
     * @param mixed $format - e.g. ['dmy' => 1], 'dmy'
     * @return int - Timestamp UTC
     */
    private function prepareWithFormat($date, $format): int
    {
        if (is_array($format)) {
            $format = key($format);
        }
        $date = $this->checkDateString($date);
        $format = $this->checkDateFormat($format);
        $date = Carbon::createFromFormat($format, $date);

        return $date->timestamp;
    }

    private function checkDateString(string $date): string
    {
        $date = str_replace(['.', '-'], '/', $date);
        return $date;
    }

    private function checkDateFormat(string $format): string
    {
        $format = implode('/', str_split($format));
        $format = str_replace(['y', 'M', 'D', '///'], ['Y', 'm', 'd', '/'], $format);
        return $format;
    }
}// CarbonDateParser