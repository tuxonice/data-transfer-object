<?php

namespace Tlab\TransferObjects;

use ReflectionClass;
use ReflectionNamedType;
use ReflectionProperty;

abstract class AbstractTransfer implements TransferInterface
{
    final public function __construct()
    {
    }

    /**
     * @return array<string,mixed>
     */
    public function toArray(bool $isRecursive = false, bool $snakeCaseKeys = false): array
    {
        $reflect = new ReflectionClass($this);
        $properties = $reflect->getProperties(ReflectionProperty::IS_PRIVATE);

        $data = [];
        foreach ($properties as $property) {
            if ($isRecursive && $this->isArrayType($property)) {
                $data[$property->getName()] = $this->processArrayType($property, $isRecursive);

                continue;
            }

            if ($isRecursive && $this->isTransferType($property->getValue($this))) {
                $data[$property->getName()] = $this->processTransferType($property->getValue($this), $isRecursive);

                continue;
            }

            $key = $snakeCaseKeys ? $this->camelCaseToSnakeCase($property->getName()) : $property->getName();
            $data[$key] = $property->getValue($this);
        }

        return $data;
    }

    /**
     * @param array<string,mixed> $data
     *
     * @return static
     */
    public static function fromArray(array $data): static
    {
        $transfer = new static();

        $reflect = new ReflectionClass($transfer);
        $properties = array_map(function (ReflectionProperty $property) {
            return $property->getName();
        }, $reflect->getProperties(ReflectionProperty::IS_PRIVATE));

        foreach ($data as $key => $value) {
            $key =  lcfirst(
                str_replace(
                    ' ',
                    '',
                    ucwords(
                        str_replace('_', ' ', $key)
                    )
                )
            );
            if (in_array($key, $properties, true)) {
                $methodName = 'set' . ucfirst($key);
                $transfer->$methodName($value);
            }
        }

        return $transfer;
    }

    /**
     * @param string $property
     *
     * @return string
     */
    private function camelCaseToSnakeCase(string $property): string
    {
        return strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $property));
    }

    /**
     * @param ReflectionProperty $property
     * @param bool $isRecursive
     *
     * @return array<int,mixed>
     */
    private function processArrayType(ReflectionProperty $property, bool $isRecursive): array
    {
        $data = [];
        foreach ($property->getValue($this) as $propertyValue) {
            if ($this->isTransferType($propertyValue)) {
                $data[] = $this->processTransferType($propertyValue, $isRecursive);

                continue;
            }

            $data[] = $propertyValue;
        }

        return $data;
    }

    /**
     * @param mixed $property
     * @param bool $isRecursive
     *
     * @return array<string,mixed>
     */
    private function processTransferType(mixed $property, bool $isRecursive): array
    {
        return $property->toArray($isRecursive);
    }

    private function isTransferType(mixed $property): bool
    {
        return $property instanceof TransferInterface;
    }

    /**
     * @param ReflectionProperty $property
     *
     * @return bool
     */
    private function isArrayType(ReflectionProperty $property): bool
    {
        /** @var ReflectionNamedType $propertyType */
        $propertyType = $property->getType();

        return $propertyType->getName() === 'array';
    }
}
