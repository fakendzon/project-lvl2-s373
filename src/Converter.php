<?php

namespace Differ\Converter;

use Symfony\Component\Yaml\Yaml;

const JSON = 'json';
const YAML = 'yaml';

function toArray($format, $data = [])
{
    $result = [];

    foreach ($data as $param) {
        $param = getFileContent($param);
        switch ($format) {
            case JSON:
                $result[] = json_decode($param, true);
                break;
            case YAML:
                $result[] = Yaml::parse($param, true);
                break;
        }
    }

    return $result;
}

function getFileContent($file)
{
    return (file_exists($file) && is_readable($file)) ? file_get_contents($file) : '';
}

function getFileExtension($fileName)
{
    return pathinfo($fileName, PATHINFO_EXTENSION);
}
