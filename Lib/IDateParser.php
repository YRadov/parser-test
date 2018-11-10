<?php
/**
 * User: radov.yuriy@ukr.net
 * Date: 10.11.2018
 */

namespace Lib;


interface IDateParser
{
    public function parse($data): int;
}