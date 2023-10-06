<?php

namespace Tlab\TransferObjects;

use ReflectionClass;
use ReflectionProperty;

abstract class AbstractTransfer implements TransferInterface
{
    final public function __construct()
    {
    }

    /**
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        $reflect = new ReflectionClass($this);
        $properties = $reflect->getProperties(ReflectionProperty::IS_PRIVATE);

        $data = [];
        foreach ($properties as $property) {
            $data[$property->getName()] = $property->getValue($this);
        }

        return $data;
    }


    /**
     * @param array<string,mixed> $data
     * @return TransferInterface
     */
    public static function fromArray(array $data): TransferInterface
    {
        $transfer = new static();
        foreach ($data as $key => $value) {
            $methodName = 'set' . ucfirst($key);
            $transfer->$methodName($value);
        }

        return $transfer;
    }
}
