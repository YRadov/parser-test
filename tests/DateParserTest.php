<?php

use Lib\CarbonDateParser;
use Lib\DateParser;
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
    private $commonParser;

    /**
     * @var HB
     */
    private $carbonParser;

    protected function setUp()
    {
        $this->commonParser = new HB(new DateParser());
        $this->carbonParser = new HB(new CarbonDateParser());
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
     * @param int $expected
     * @throws Exception
     */
    public function testDateParserUseCarbon($date, int $expected)
    {
        $this->assertEquals($expected, $this->carbonParser::dtParse($date));
    }

    /**
     * @dataProvider provideDates
     *
     * @param mixed $date
     * @param int $expected
     * @throws Exception
     */
//    public function testDateParser($date, int $expected)
//    {
//        $this->assertEquals($expected, $this->commonParser::dtParse($date));
//    }
}// DateParserTest