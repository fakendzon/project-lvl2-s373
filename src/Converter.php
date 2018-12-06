<?php

namespace Differ\Converter;

function toArray($format, $data = [])
{
    $result = [];

    foreach ($data as $param) {
        $param = getFileContent($param);
        switch ($format) {
            case 'json':
                $result[] = json_decode($param, true);
                break;
        }
    }

    return $result;
}

function getFileContent($file)
{
    return (file_exists($file) && is_readable($file)) ? file_get_contents($file) : '';
}
