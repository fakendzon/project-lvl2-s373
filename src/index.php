<?php

namespace GenerateDiff;

function run()
{

    $doc = <<<DOC
Usage: my_program.php [-hso FILE] [--quiet | --verbose] [INPUT ...]

Options:
  -h --help    show this
  -s --sorted  sorted output
  -o FILE      specify output file [default: ./test.txt]
  --quiet      print less text
  --verbose    print more text

DOC;

    $args = (new \Docopt\Handler)->handle($doc);
}
