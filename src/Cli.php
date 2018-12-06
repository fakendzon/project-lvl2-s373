<?php

namespace Differ\Cli;

use function Differ\Diff\generateDiff;

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
