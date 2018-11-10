<?php

use Lib\CarbonDateParser;
use Lib\HB;

/**
 * User: radov.yuriy@ukr.net
 * Date: 10.11.2018
 */

class DateParserTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var HB
     */
    private $parser;

    protected function setUp()
    {
        $this->parser = new HB(new CarbonDateParser());
    }

    public function provideDates()
    {
        $dates = include 'dates.php';
        return $dates;
    }

    /**
     * @dataProvider provideDates
     *
     * @param mixed $date
     * @param array|string $format
     * @param int $expected
     * @throws Exception
     */
    public function testDateParser($date, $format, int $expected)
    {
        $this->assertEquals($expected, $this->parser::dtParse($date, $format));
    }
}// DateParserTest