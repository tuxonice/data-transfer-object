<?php

namespace Tlab\TransferObjects;

use Tlab\TransferObjects\Exceptions\ArrayTypeNullableException;
use Tlab\TransferObjects\Exceptions\DefinitionException;

class DefinitionProvider
{
    private const NATIVE_TYPES = ['string', 'int', 'float', 'bool'];
    private const FILE_PATTERN = '*.json';

    public function __construct(
        private readonly string $definitionPath,
        private readonly string $namespace,
    ) {
    }

    /**
     * @return array<int,array<string, mixed>>
     * @throws DefinitionException|ArrayTypeNullableException
     */
    public function provide(): array
    {
        $schemaValidator = new SchemaValidator();
        $definitions = [];
        $fileDefinitionList = glob($this->definitionPath . DIRECTORY_SEPARATOR . self::FILE_PATTERN);
        if ($fileDefinitionList === false || $fileDefinitionList === []) {
            throw new DefinitionException('No definition files found on ' . $this->definitionPath);
        }
        foreach ($fileDefinitionList as $filename) {
            $errors = [];
            $fileContent = @file_get_contents($filename);
            if ($fileContent === false) {
                throw new DefinitionException(sprintf('Could not read definition file: %s', $filename));
            }

            if (!$schemaValidator->validate($fileContent, $errors)) {
                throw new DefinitionException('Invalid definition file: ' . $filename . implode("\n", $errors));
            }
            $decodeFile = json_decode($fileContent, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new DefinitionException(sprintf('Invalid JSON in file %s: %s', $filename, json_last_error_msg()));
            }
            if (!isset($decodeFile['transfers']) || !is_array($decodeFile['transfers'])) {
                throw new DefinitionException(sprintf('Missing or invalid transfers array in file %s', $filename));
            }
            $definitions = array_merge($definitions, $decodeFile['transfers']);
        }

        $transfers = [];
        foreach ($definitions as $definition) {
            $isImmutable = $definition['immutable'] ?? false;
            $className = $isImmutable ? $definition['name'] . 'TransferImmutable' : $definition['name'] . 'Transfer';
            $useNamespaces = [
                'Tlab\TransferObjects\AbstractTransfer'
            ];
            $classTransfer = [
                'namespace' => $this->namespace,
                'className' => $className,
                'abstractClass' => 'AbstractTransfer',
                'deprecationDescription' => $definition['deprecationDescription'] ?? null,
                'immutable' => $isImmutable,
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
     *
     * @return array<string,mixed>
     * @throws ArrayTypeNullableException
     */
    private function processProperty(array $property): array
    {
        if (str_ends_with($property['type'], '[]')) {
            if (isset($property['nullable']) && $property['nullable'] === true) {
                throw new ArrayTypeNullableException('Invalid nullable property for array types');
            }

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
                'nullable' => false,
                'deprecationDescription' => $property['deprecationDescription'] ?? null,
            ];
        }

        return [
            'type' => 'array',
            'elementsType' => $elementsType,
            'camelCaseName' => $property['name'],
            'camelCaseSingularName' => $property['singular'],
            'nullable' => false,
            'deprecationDescription' => $property['deprecationDescription'] ?? null,
        ];
    }

    /**
     * Process non-native type properties and return their configuration
     *
     * @param array<string,mixed> $property Property configuration
     * @return array<string,mixed> Processed property configuration with type, name, namespace, and nullable status
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
