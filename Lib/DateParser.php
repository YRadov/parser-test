<?php
/**
 * User: radov.yuriy@ukr.net
 * Date: 10.11.2018
 */

namespace Lib;


class DateParser
{
    public function parse(IParser $parser, $data): int
    {
        return $parser->parse($data);
    }
}// DateParser