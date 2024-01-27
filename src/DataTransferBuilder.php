<?php

namespace Tlab\TransferObjects;

use Tlab\TransferObjects\Exceptions\DefinitionException;

class DataTransferBuilder
{
    public function __construct(
        private readonly string $definitionPath,
        private readonly string $outputPath,
        private readonly string $namespace,
    ) {
    }

    /**
     * @throws DefinitionException|Exceptions\ArrayTypeNullableException
     */
    public function build(): void
    {
        $this->validate($this->definitionPath, $this->outputPath, $this->namespace);
        $definitionBuilder = new DefinitionProvider($this->definitionPath, $this->namespace);
        $definitions = $definitionBuilder->provide();

        $outputBuilder = new OutputBuilder($this->outputPath, $definitions);
        $outputBuilder->save();
    }

    /**
     * @throws DefinitionException
     */
    private function validate(string $definitionPath, string $outputPath, string $namespace): void
    {
        if (!is_dir($definitionPath) || !is_readable($definitionPath)) {
            throw new DefinitionException('The definition path is missing or is not readable');
        }

        if (!is_dir($outputPath) || !is_writable($outputPath)) {
            throw new DefinitionException('The output path is missing or is not writable');
        }

        if (trim($namespace) === '') {
            throw new DefinitionException('Namespace is missing');
        }
    }
}
