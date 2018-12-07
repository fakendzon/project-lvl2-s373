<?php

namespace Differ\Viewer;

function getJson($array = [])
{
    return json_encode($array, JSON_PRETTY_PRINT);
}
