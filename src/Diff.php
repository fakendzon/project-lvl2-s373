<?php

namespace Differ\Diff;

use function Funct\Collection\flattenAll;
use function Funct\Collection\union;
use function Differ\Factory\buildFileObject;
use function Differ\Viewer\getPresentationDiff;

const MARK_ADDED   = '+';
const MARK_REMOVED = '-';
const MARK_EQUAL   = '  ';

function generateDiffFiles($filePath1, $filePath2)
{
    $fileObj1 = buildFileObject($filePath1);
    $fileObj2 = buildFileObject($filePath2);
    $diff     = generateDiff($fileObj1['contentToArray'], $fileObj2['contentToArray']);
    return getPresentationDiff($diff);
}

function generateDiff($data1, $data2)
{
    $union  = union($data1, $data2);

    $diff = array_map(function ($key, $item) use ($data1, $data2) {
        if (array_key_exists($key, $data1) && array_key_exists($key, $data2)) {
            if ($item != $data1[$key]) {
                return [
                    MARK_ADDED . " {$key}: {$item}",
                    MARK_REMOVED . " {$key}: {$data1[$key]}"
                ];
            } else {
                return MARK_EQUAL . "{$key}: {$item}";
            }
        } elseif (array_key_exists($key, $data1)) {
            return MARK_REMOVED . " {$key}: {$item}";
        } elseif (array_key_exists($key, $data2)) {
            return MARK_ADDED . " {$key}: {$item}";
        }
    }, array_keys($union), $union);

    return flattenAll($diff);
}
