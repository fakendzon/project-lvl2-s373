<?php

namespace Differ\Controller;

use function Differ\Diff\generateDiff;
use function Differ\Factory\build;
use function Differ\Viewer\getJson;

function getDiffFiles($fileName1, $fileName2)
{
    $file1 = build($fileName1);
    $file2 = build($fileName2);
    $diff  = generateDiff($file1['toArray'], $file2['toArray']);
    return getJson($diff);
}
