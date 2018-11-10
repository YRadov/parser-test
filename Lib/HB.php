<?php
/**
 * User: radov.yuriy@ukr.net
 * Date: 10.11.2018
 */

namespace Lib;


class HB
{
    /**
     * @var IParser
     */
    private static $parser;

    /**
     * HB constructor.
     * @param IParser $parser
     */
    public function __construct(IParser $parser)
    {
        self::$parser = $parser;
    }

    public static function dtParse($data, $format = null)
    {
        return self::$parser->parse($data, $format);
    }
}// HB