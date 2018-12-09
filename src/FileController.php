<?php

namespace Differ\FileController;

use function Differ\Diff\generateDiff;
use function Differ\Factory\buildFileObject;
use function Differ\Viewer\getPresentationDiff;

function getDiffFiles($filePath1, $filePath2)
{
    $fileObj1 = buildFileObject($filePath1);
    $fileObj2 = buildFileObject($filePath2);
    $diff     = generateDiff($fileObj1['contentToArray'], $fileObj2['contentToArray']);
    return getPresentationDiff($diff);
}
