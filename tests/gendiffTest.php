<?php

namespace GenerateDiff\Tests;

use \PHPUnit\Framework\TestCase;
use function Differ\Diff\generateDiff;

class GendiffTest extends TestCase
{
    public function testGenerateDiff()
    {
        $actual = generateDiff(__DIR__.'/before.json', __DIR__.'/after.json');
        $expected = json_encode([
            'host'      => 'hexlet.io',
            '+ timeout' => 20,
            '- timeout' => 50,
            '- proxy'   => '123.234.53.22',
            '+ verbose' => true
        ], JSON_PRETTY_PRINT);

        $this->assertEquals($expected, $actual);
    }
}
