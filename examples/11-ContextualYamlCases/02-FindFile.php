<?php

use Oliverde8\Component\PhpEtl\ChainBuilder;
use Oliverde8\Component\PhpEtl\Item\DataItem;
use Symfony\Component\Yaml\Yaml;

require_once __DIR__ . '/../.initYaml.php';
/** @var ChainBuilder $chainBuilder */

$fileName = __DIR__ . '/config/02-find-file.yml';

$dir = __DIR__ . '/data/02-find-file';
copy(__DIR__ . '/data/file1-demo.csv', "$dir/file1.csv");

$chainProcessor = $chainBuilder->buildChainProcessor(Yaml::parse(file_get_contents($fileName)), []);

$chainProcessor->process(
    new ArrayIterator([new DataItem('/^file[0-9]\.csv$/')]),
    [
        'dir' => $dir,
    ]
);
