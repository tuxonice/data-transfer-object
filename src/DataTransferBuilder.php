<?php

namespace TransferObjects;

use Webmozart\Assert\Assert;

class DataTransferBuilder
{
    private string $definitionPath;

    private string $outputPath;

    public function __construct(string $definitionPath, string $outputPath)
    {
        Assert::directory($definitionPath, 'Missing definition path');
        Assert::directory($outputPath, 'Missing output path');

        Assert::writable($definitionPath, 'Definition path is not writable');
        Assert::readable($outputPath, 'Output path is not readable');

        $this->definitionPath = $definitionPath;
        $this->outputPath = $outputPath;
    }

    public function build(): void
    {
        $definitionBuilder = new DefinitionProvider($this->definitionPath);
        $definitions = $definitionBuilder->provide();

        $outputBuilder = new OutputBuilder($this->outputPath, $definitions);
        $outputBuilder->save();
    }
}
