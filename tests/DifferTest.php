<?php

namespace Differ\Tests;

use \PHPUnit\Framework\TestCase;
use function Differ\FileController\getDiffFiles;

class GendiffTest extends TestCase
{
    const DIR_FIXTURES = __DIR__ . '/fixtures/';

    public function testDiffJson()
    {
        $actual   = getDiffFiles(self::DIR_FIXTURES . 'before.json', self::DIR_FIXTURES . '/after.json');
        $expected = file_get_contents(self::DIR_FIXTURES . 'result.json');
        $this->assertEquals($expected, $actual);
    }

    public function testDiffYml()
    {
        $actual = getDiffFiles(self::DIR_FIXTURES . 'before.yml', self::DIR_FIXTURES . '/after.yml');
        $expected = file_get_contents(self::DIR_FIXTURES . 'result.json');
        $this->assertEquals($expected, $actual);
    }
}
