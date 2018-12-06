<?php

namespace Differ\Viewer;

function showJson($array = [])
{
    return json_encode($array, JSON_PRETTY_PRINT);
}
