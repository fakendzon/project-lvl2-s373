<?php

namespace Differ\Factory;

use Symfony\Component\Yaml\Yaml;

const JSON = 'json';
const YAML = 'yml';

function buildFileObject($filePath)
{
    $format      = getFileExtension($filePath);
    $fileContent = getFileContent($filePath);
    return ['contentToArray' => toArray($format, $fileContent)];
}

function toArray($format, $content)
{
    $result = [];

    switch ($format) {
        case JSON:
            $result = json_decode($content, true);
            break;
        case YAML:
            $result = Yaml::parse($content, true);
            break;
    }

    return array_map(function ($item) {
        return is_bool($item) ? json_encode($item) : $item;
    }, $result);
}

function getFileExtension($fileName)
{
    return pathinfo($fileName, PATHINFO_EXTENSION);
}

function getFileContent($file)
{
    return (file_exists($file) && is_readable($file)) ? file_get_contents($file) : '';
}
