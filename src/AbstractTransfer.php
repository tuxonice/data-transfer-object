<?php

namespace Tlab\TransferObjects;

abstract class AbstractTransfer implements TransferInterface
{
    final public function __construct()
    {
    }

    public function toArray(bool $isRecursive = true, bool $camelCasedKeys = false): array
    {
        //TODO: implement
        return [];
    }

    public static function fromArray(array $data, bool $ignoreMissingProperty = false): TransferInterface
    {
        //TODO: implement
        $transfer = new static();
        foreach ($data as $key => $value) {
            $methodName = 'set' . ucfirst($key);
            $transfer->$methodName($value);
        }

        return $transfer;
    }
}
