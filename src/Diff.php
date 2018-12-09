<?php

namespace Differ\Diff;

use function Funct\Collection\flattenAll;
use function Funct\Collection\union;

const MARK_ADDED   = '+';
const MARK_REMOVED = '-';
const MARK_EQUAL   = '  ';

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
