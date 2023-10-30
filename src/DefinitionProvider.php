<?php

namespace Tlab\TransferObjects;

use Tlab\TransferObjects\Exceptions\DefinitionException;

class DefinitionProvider
{
    private const NATIVE_TYPES = ['string', 'int', 'float', 'bool'];

    public function __construct(
        private readonly string $definitionPath,
        private readonly string $namespace,
    ) {
    }

    /**
     * @return array<int,array<string, mixed>>
     */
    public function provide(): array
    {
        $schemaValidator = new SchemaValidator();
        $definitions = [];
        foreach (glob($this->definitionPath . DIRECTORY_SEPARATOR . '*.json') as $filename) {
            $errors = [];
            if (!$schemaValidator->validate((string)file_get_contents($filename), $errors)) {
                throw new DefinitionException('Invalid definition file: ' . $filename);
            }
            $decodeFile = json_decode((string)file_get_contents($filename), true);
            $definitions = array_merge($definitions, $decodeFile['transfers']);
        }

        $transfers = [];
        foreach ($definitions as $definition) {
            $useNamespaces = [
                'Tlab\TransferObjects\AbstractTransfer'
            ];
            $classTransfer = [
                'namespace' => $this->namespace,
                'className' => $definition['name'] . 'Transfer',
                'abstractClass' => 'AbstractTransfer',
                'deprecationDescription' => $definition['deprecationDescription'] ?? null,
            ];

            $classProperties = [];
            foreach ($definition['properties'] as $property) {
                if (isset($property['namespace'])) {
                    $useNamespaces[] = trim($property['namespace'], '\\');
                }

                $classProperties[] = $this->processProperty($property);
            }

            $useNamespaces = array_unique($useNamespaces);
            sort($useNamespaces, SORT_STRING);
            $classTransfer['useNamespaces'] = $useNamespaces;
            $classTransfer['properties'] = $classProperties;
            $transfers[] = $classTransfer;
        }

        return $transfers;
    }

    /**
     * @param array<string,mixed> $property
     * @return array<string,mixed>
     */
    private function processProperty(array $property): array
    {
        if (str_ends_with($property['type'], '[]')) {
            return $this->processArrayType($property);
        }

        if (!in_array($property['type'], self::NATIVE_TYPES)) {
            return $this->processNonNativeType($property);
        }

        return [
            'type' => $property['type'],
            'camelCaseName' => $property['name'],
            'nullable' => $property['nullable'] ?? false,
            'deprecationDescription' => $property['deprecationDescription'] ?? null,
        ];
    }

    /**
     * @param array<string,mixed> $property
     * @return array<string,mixed>
     */
    private function processArrayType(array $property): array
    {
        $elementsType = substr($property['type'], 0, -2);

        if (!in_array($elementsType, self::NATIVE_TYPES)) {
            return [
                'type' => 'array',
                'elementsType' => $elementsType,
                'camelCaseName' => $property['name'],
                'camelCaseSingularName' => $property['singular'],
                'namespace' => isset($property['namespace']) ? trim($property['namespace'], '\\') : null,
                'nullable' => $property['nullable'] ?? false,
                'deprecationDescription' => $property['deprecationDescription'] ?? null,
            ];
        }

        return [
            'type' => 'array',
            'elementsType' => $elementsType,
            'camelCaseName' => $property['name'],
            'camelCaseSingularName' => $property['singular'],
            'nullable' => $property['nullable'] ?? false,
            'deprecationDescription' => $property['deprecationDescription'] ?? null,
        ];
    }

    /**
     * @param array<string,string|null> $property
     *
     * @return array<string,string|null|false>
     */
    private function processNonNativeType(array $property): array
    {
        return [
            'type' => $property['type'],
            'camelCaseName' => $property['name'],
            'namespace' => isset($property['namespace']) ? trim($property['namespace'], '\\') : null,
            'nullable' => $property['nullable'] ?? false,
            'deprecationDescription' => $property['deprecationDescription'] ?? null,
        ];
    }
}
