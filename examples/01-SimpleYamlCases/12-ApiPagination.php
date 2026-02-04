<?php

use Oliverde8\Component\PhpEtl\ChainBuilder;
use Oliverde8\Component\PhpEtl\Item\DataItem;
use Symfony\Component\Yaml\Yaml;

require_once __DIR__ . '/../.initYaml.php';
/** @var ChainBuilder $chainBuilder */

$fileName = __DIR__ . '/config/12-api-pagination.yml';

class Counter
{
    protected $count = 0;

    public function increment(): int
    {
        return $this->count++;
    }
}

$counter = new Counter();

$chainProcessor = $chainBuilder->buildChainProcessor(Yaml::parse(file_get_contents($fileName)), []);

$chainProcessor->process(
    new ArrayIterator([new DataItem([])]),
    ['counter' => $counter]
);
