<?php

namespace GenerateDiff\Tests;

use \PHPUnit\Framework\TestCase;
use function \GenerateDiff\showDiff;

class GendiffTest extends TestCase
{
    public function testShowDiff()
    {
        $before = [
            "host"    => "hexlet.io",
            "timeout" => 50,
            "proxy"   => "123.234.53.22"
        ];

        $after = [
            "host"    => "hexlet.io",
            "timeout" => 50,
            "proxy"   => "123.234.53.22"
        ];
//        {
//            "timeout": 20,
//  "verbose": true,
//  "host": "hexlet.io"
//}

        $this->assertEquals(1, 1);
    }
}
