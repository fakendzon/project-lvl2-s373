<?php

namespace Differ\Factory;

use Symfony\Component\Yaml\Yaml;

const JSON = 'json';
const YAML = 'yml';

function getFileData($filePath)
{
    $format      = getFileExtension($filePath);
    $fileContent = getFileContent($filePath);
    return ['toArray' => toArray($format, $fileContent)];
}

function toArray($format, $fileContent)
{
    $result = [];

    switch ($format) {
        case JSON:
            $result = json_decode($fileContent, true);
            break;
        case YAML:
            $result = Yaml::parse($fileContent, true);
            break;
    }

    return $result;
}

function getFileExtension($fileName)
{
    return pathinfo($fileName, PATHINFO_EXTENSION);
}

function getFileContent($file)
{
    return (file_exists($file) && is_readable($file)) ? file_get_contents($file) : '';
}
