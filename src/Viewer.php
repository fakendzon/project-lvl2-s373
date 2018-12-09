<?php

namespace Differ\Viewer;

function getJson($array = [])
{
    return json_encode($array, JSON_PRETTY_PRINT);
}

function getPresentationDiff($array = [])
{
    return implode("\n", array_merge(
        ["{"],
        array_map(function ($item) {
            return "  {$item}";
        }, $array),
        ["}"]
    ));
}
