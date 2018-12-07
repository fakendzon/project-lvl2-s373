<?php

namespace Differ\Factory;

const JSON = 'json';
const YAML = 'yml';

function build($fileName)
{
    return ['toArray' => toArray($fileName)];
}

function toArray($fileName)
{
    $result = [];

    $format      = getFileExtension($fileName);
    $fileContent = getFileContent($fileName);
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

function getFileContent($file)
{
    return (file_exists($file) && is_readable($file)) ? file_get_contents($file) : '';
}

function getFileExtension($fileName)
{
    return pathinfo($fileName, PATHINFO_EXTENSION);
}
