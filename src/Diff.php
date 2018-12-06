<?php

namespace Differ\Diff;

use function Differ\Converter\toArray;
use function Differ\Viewer\showJson;
use function Funct\Collection\union;

const MARK_ADDED   = '+';
const MARK_REMOVED = '-';

function generateDiff($file1, $file2)
{
    $data   = toArray('json', [$file1, $file2]);
    $union  = union($data[0], $data[1]);
    $result = [];
    array_map(function ($key, $item) use ($data, &$result) {
        if (array_key_exists($key, $data[0]) && array_key_exists($key, $data[1])) {
            if ($item != $data[0][$key]) {
                $result[MARK_ADDED . " " . $key] = $item;
                $result[MARK_REMOVED . " " . $key] = $item;
            } else {
                $result[$key] = $item;
            }
        } elseif (array_key_exists($key, $data[0])) {
            return $result[MARK_REMOVED . " " . $key] = $item;
        } elseif (array_key_exists($key, $data[1])) {
            return $result[MARK_ADDED . " " . $key] = $item;
        }
    }, array_keys($union), $union);

    return showJson($result);
}
