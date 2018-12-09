<?php

namespace Differ\Viewer;

function getJson($array = [])
{
    return json_encode($array, JSON_PRETTY_PRINT);
}

function presentationDiff($array = [])
{
    $array = array_map(function ($item) {
        return "  {$item}";
    }, $array);
    array_unshift($array, "{");
    $array[] = "}";
    return implode("\n", $array);
}
