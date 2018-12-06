<?php

namespace Differ\Tests;

use \PHPUnit\Framework\TestCase;
use function Differ\Diff\generateDiff;

class GendiffTest extends TestCase
{
    const DIR_FIXTURES = __DIR__ . '/fixtures/';

    public function testDiffJson()
    {
        $actual = generateDiff(self::DIR_FIXTURES . 'before.json', self::DIR_FIXTURES . '/after.json');
        $expected = json_encode(file_get_contents(self::DIR_FIXTURES . 'result.json'));

        $this->assertJson($expected, $actual);
    }

    /*
    public function testDiffYml()
    {
        $actual = generateDiff(self::DIR_FIXTURES . 'before.yml', self::DIR_FIXTURES . '/after.yml');
        $expected = json_encode(file_get_contents(self::DIR_FIXTURES . 'result.json'));

        $this->assertJson($expected, $actual);
    }
    */
}
