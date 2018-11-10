<?php
/**
 * User: radov.yuriy@ukr.net
 * Date: 10.11.2018
 */

namespace Lib;


use Carbon\Carbon;

abstract class DateParser
{
    protected static $usedFmts = [
        'l, M j Y',
        'Y M j',
        'j F, y',
        'y',
        'm/y',
        'm/Y',
        'M y',
        'F y',
        'My',
        'Fy',
        'y M',
        'y F',
        'yM',
        'yF',
        'M Y',
        'MY',
        'F Y',
        'FY',
        'Y M',
        'YM',
        'Y F',
        'YF',
        'Ym',
        'Y',
    ];

    protected static $fmtsWithDays_ = [
        'j F, y',
        'l, M j Y',
        'Y M j',
    ];

    protected static $fmtsWithoutMonth = [
        'y',
        'Y'
    ];

    protected function prepareDate($date, $format)
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
    protected function prepareWithFormat($date, $format): int
    {
        if (is_array($format)) {
            $format = key($format);
        }
        $date = $this->checkDateString($date);
        $format = $this->checkDateFormat($format);
        try {
            $date = Carbon::createFromFormat($format, $date);
        } catch (\Exception $e) {
            throw new \InvalidArgumentException('Failed parse date: ' . $date);

        }
        return $date->timestamp;
    }

    protected function checkDateString(string $date): string
    {
        $date = str_replace(['.', '-'], '/', $date);
        return $date;
    }

    protected function checkDateFormat(string $format): string
    {
        $format = implode('/', str_split($format));
        $format = str_replace(['y', 'M', 'D', '///'], ['Y', 'm', 'd', '/'], $format);
        return $format;
    }

    protected function makeWrongDay(string $date, string $result): string
    {
        preg_match('/[^0-9]([0-9]{1,2})\s/', $date, $matches);
        if (!isset($matches[1])) {
            return $result;
        }
        $dayNum = $matches[1];
        $dayNum = str_pad($dayNum, 2, '0', STR_PAD_LEFT);
        $result = substr_replace($result, $dayNum, -2);
        return $result;
    }

    protected function dateWithoutDays(string $date): bool
    {
        foreach (self::$usedFmts as $format) {
            try {
                $d = Carbon::createFromFormat($format, $date);
            } catch (\Exception $e) {
                continue;
            }
            if ($d->format($format) === $date && !$this->formatWithDays($format)) {
                return true;
            }
        }
        return false;
    }

    protected function removeDays(string $date): string
    {
        return substr_replace($date, '00', -2);
    }

    protected function dateWithoutMonth(string $date): bool
    {
        foreach (self::$fmtsWithoutMonth as $format) {
            try {
                $d = Carbon::createFromFormat($format, $date);
            } catch (\Exception $e) {
                continue;
            }
            if ($d->format($format) === $date) {
                return true;
            }
        }
        return false;
    }

    protected function removeMonth(string $date): string
    {
        return substr_replace($date, '00', -4, 2);
    }

    protected function tryCreateFromExtraFormats(string $date): Carbon
    {
        foreach (self::$usedFmts as $format) {
            try {
                $carbon = Carbon::createFromFormat($format, $date);
            } catch (\Exception $e) {
                continue;
            }
            return $carbon;
        }
        throw new \InvalidArgumentException('Failed parse date: ' . $date);
    }

    protected function formatWithDays(string $format): bool
    {
        return in_array($format, self::$fmtsWithDays_);
    }
}// DateParser