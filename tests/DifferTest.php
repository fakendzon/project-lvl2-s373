<?php

namespace Differ\Tests;

use function Differ\Diff\generateDiffFiles;
use \PHPUnit\Framework\TestCase;

class GendiffTest extends TestCase
{
    const DIR_FIXTURES = __DIR__ . '/fixtures/';

    public function testDiffJson()
    {
        $actual   = generateDiffFiles(self::DIR_FIXTURES . 'before.json', self::DIR_FIXTURES . '/after.json');
        $expected = file_get_contents(self::DIR_FIXTURES . 'result.json');
        $this->assertEquals($expected, $actual);
    }

    public function testDiffYml()
    {
        $actual = generateDiffFiles(self::DIR_FIXTURES . 'before.yml', self::DIR_FIXTURES . '/after.yml');
        $expected = file_get_contents(self::DIR_FIXTURES . 'result.json');
        $this->assertEquals($expected, $actual);
    }
}
