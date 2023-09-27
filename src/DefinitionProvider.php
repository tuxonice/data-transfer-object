<?php

namespace Tlab\TransferObjects;

class DefinitionProvider
{
    public function __construct(
        private readonly string $definitionPath,
        private readonly string $namespace,
    ) {
    }

    public function provide(): array
    {
        $definitions = [];
        foreach (glob($this->definitionPath . DIRECTORY_SEPARATOR . '*.json') as $filename) {
            $decodeFile = json_decode(file_get_contents($filename), true);
            $definitions = array_merge($decodeFile['transfers'], $definitions);
        }

        $tranfers = [];
        foreach ($definitions as $definition) {
            $classTransfer = [
                'namespace' => $this->namespace,
                'className' => $definition['name'] . 'Transfer',
                'abstractClass' => 'AbstractTransfer',
            ];

            $classProperties = [];
            foreach ($definition['properties'] as $property) {
                $classProperties[] = [
                    'type' => $property['type'],
                    'camelCaseName' => $property['name'],
                    'nullable' => $property['nullable']
                ];
            }

            $classTransfer['properties'] = $classProperties;
            $tranfers[] = $classTransfer;
        }

        return $tranfers;
    }
}
