<?php

namespace Differ\Cli;

use function Differ\Controller\getDiffFiles;

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

    print_r(getDiffFiles($args->args['<firstFile>'], $args->args['<secondFile>']));
}
