<?php

namespace Differ\Diff;

use function Funct\Collection\flattenAll;
use function Funct\Collection\merge;
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
    $diff     = generateDiff1(
        $fileObj1['contentToArray'],
        $fileObj2['contentToArray'],
        array_union_recursive($fileObj1['contentToArray'], $fileObj2['contentToArray'])
    );
    print_r(array_union_recursive($fileObj1['contentToArray'], $fileObj2['contentToArray']));
    die;
    var_export($diff);
    die;
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

function generateDiff1($data1, $data2, $union = [])
{
//    $ast1 = getAst($data1);
//    $ast2 = getAst($data2);

//    print_r(array_union_recursive($data1, $data2));
//    die;
    print_r($union);
    die;
    return array_map(function ($item) use ($data1, $data2, $union) {
        if (array_key_exists($item, $data1) && array_key_exists($item, $data2)) {
            return ['type' => 'c', 'key' => $item, 'children' => $union[$item]];
        } elseif (array_key_exists($item, $data1)) {
            return ['type' => 'c', 'key' => $item, 'children' => $union[$item]];
        } elseif (array_key_exists($item, $data2)) {
            return ['type' => 'c', 'key' => $item, 'children' => $union[$item]];
        }
    }, $union);
//    print_r(array_union_recursive($ast1, $ast2));
//    print_r(array_merge_recursive($data1, $data2));
//    print_r($ast1);
//    die;
//    $union  = union($data1, $data2);
//    $union  = union($ast1, $ast2);
//    print_r($union);
}

function array_union_recursive($array1, $array2)
{
    foreach ($array2 as $key => $value)
    {
        if(is_array($value))
        {
            $array1[$key] = array_union_recursive($array1[$key], $array2[$key]);
        }
        else
        {
            $array1[$key] = $value;
        }
    }
    return $array1;

    return array_map(function ($key, $item) use ($array1) {
        print_r($item);
        print_r($array1[$key]);

//        die;
        return is_array($item) ? [$key => array_union_recursive($array1[$key], $item)] : union([$key => $array1[$key]], [$key => $item]);
    }, array_keys($array2), $array2);
}

function getAst($array = [])
{
    return array_map(function ($key, $item) {
//        return is_array($item) ? ['key' => $key, 'children' => getAst($item)] : "{$key}: {$item}";
        return is_array($item) ? ['key' => $key, 'children' => getAst($item)] : [$key => $item];
    }, array_keys($array), $array);
}
