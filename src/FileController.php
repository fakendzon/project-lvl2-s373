<?php

namespace Differ\FileController;

use function Differ\Diff\generateDiff;
use function Differ\Factory\getFileData;
use function Differ\Viewer\getJson;

function getDiffFiles($filePath1, $filePath2)
{
    $fileData1 = getFileData($filePath1);
    $fileData2 = getFileData($filePath2);
    $diff      = generateDiff($fileData1['toArray'], $fileData2['toArray']);
    return getJson($diff);
}
