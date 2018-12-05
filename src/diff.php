<?php

namespace Differ\Diff;

use function Differ\Converter\toArray;
use function Differ\Viewer\showJson;

const MARK_ADDED   = '+';
const MARK_REMOVED = '-';

function run()
{

    $doc = <<<DOC
Generate diff

Usage:
  gendiff (-h|--help)
  gendiff [--format <fmt>] <firstFile> <secondFile>

Options:
  -h --help                     Show this screen
  --format <fmt>                Report format [default: pretty]
DOC;

    $args = (new \Docopt\Handler())->handle($doc);

    var_export(generateDiff($args->args['<firstFile>'], $args->args['<secondFile>']));
}

function generateDiff($file1, $file2)
{
    $data    = toArray('json', [$file1, $file2]);
    $added   = array_diff($data[1], $data[0]);
    $removed = array_diff($data[0], $data[1]);
    $result  = [];

    foreach ($data[0] as $key => $feild) {
        if (array_key_exists($key, $added)) {
            $result[MARK_ADDED . " " . $key] = $added[$key];
        }

        if (array_key_exists($key, $removed)) {
            $result[MARK_REMOVED . " " . $key] = $removed[$key];
        }

        if (!(array_key_exists($key, $removed) || array_key_exists($key, $added))) {
            $result[$key] = $data[0][$key];
        }
    }


    foreach ($addedFull = array_diff($added, $result) as $key => $value) {
        $result[MARK_ADDED . " " . $key] = $addedFull[$key];
    }

    return showJson($result);
}
