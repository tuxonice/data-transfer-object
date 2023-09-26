<?php

namespace Tlab\TransferObjects;

use Webmozart\Assert\Assert;

class DataTransferBuilder
{
    public function __construct(
        private readonly string $definitionPath,
        private readonly string $outputPath,
        private readonly string $namespace,
    ) {
        Assert::directory($definitionPath, 'Missing definition path');
        Assert::directory($outputPath, 'Missing output path');

        Assert::writable($definitionPath, 'Definition path is not writable');
        Assert::readable($outputPath, 'Output path is not readable');

        Assert::notEmpty($namespace, 'Namespace is missing');
    }

    public function build(): void
    {
        $definitionBuilder = new DefinitionProvider($this->definitionPath, $this->namespace);
        $definitions = $definitionBuilder->provide();

        $outputBuilder = new OutputBuilder($this->outputPath, $definitions);
        $outputBuilder->save();
    }
}
